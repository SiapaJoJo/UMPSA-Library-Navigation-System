<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
            'history' => 'array',
        ]);

        $useGroq = (bool) config('services.groq.key');
        $apiKey = $useGroq ? config('services.groq.key') : config('services.openai.key');
        $baseUrl = $useGroq ? 'https://api.groq.com/openai/v1' : 'https://api.openai.com/v1';
        $groqModel = config('services.groq.model', 'llama-3.1-8b-instant');
        $model = $useGroq ? $groqModel : 'gpt-4o-mini';
        if (!$apiKey) {
            \Log::error('[ChatController] Missing API key', ['useGroq' => $useGroq]);
            return response()->json([
                'error' => $useGroq
                    ? 'GROQ API key is not configured on the server.'
                    : 'OpenAI API key is not configured on the server.'
            ], 500);
        }

        \Log::info('[ChatController] Handling chat request', [
            'has_key' => true,
            'env' => app()->environment(),
            'provider' => $useGroq ? 'groq' : 'openai',
        ]);

        $messages = [
            [
                'role' => 'system',
                'content' => 'You are Library Assistant for UMPSA Library. Be concise, helpful, and accurate about library navigation, floors, tours, gallery, and contact info. If asked unrelated things, politely steer back to library topics.',
            ],
        ];

        if (!empty($validated['history']) && is_array($validated['history'])) {
            foreach ($validated['history'] as $m) {
                if (isset($m['role'], $m['content']) && \is_string($m['role']) && \is_string($m['content'])) {
                    $messages[] = ['role' => $m['role'], 'content' => $m['content']];
                }
            }
        }

        $messages[] = [
            'role' => 'user',
            'content' => $validated['message'],
        ];

        try {
            $client = Http::withToken($apiKey)
                ->timeout(20);

            if (app()->environment('local')) {
                $client = $client->withOptions(['verify' => false]);
            }

            $response = $client
                ->post("{$baseUrl}/chat/completions", [
                    'model' => $model,
                    'messages' => $messages,
                    'temperature' => 0.3,
                    'max_tokens' => 400,
                ]);

            if ($response->failed()) {
                \Log::error('[ChatController] OpenAI request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return response()->json([
                    'error' => 'Chat API request failed',
                    'status' => $response->status(),
                    'details' => $response->json() ?: $response->body(),
                ], 502);
            }

            $data = $response->json();
            $answer = $data['choices'][0]['message']['content'] ?? 'Sorry, I could not generate a response.';

            return response()->json([
                'reply' => $answer,
            ]);
        } catch (\Throwable $e) {
            \Log::error('[ChatController] Unexpected error contacting OpenAI', [
                'message' => $e->getMessage(),
            ]);
            return response()->json([
                'error' => 'Unexpected error while contacting Chat API',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}


