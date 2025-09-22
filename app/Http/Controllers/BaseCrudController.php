<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

abstract class BaseCrudController extends Controller
{
    protected Model $model;
    protected string $viewPath;
    protected string $routePrefix;
    
    public function __construct(Model $model, string $viewPath, string $routePrefix)
    {
        $this->model = $model;
        $this->viewPath = $viewPath;
        $this->routePrefix = $routePrefix;
    }
    
    /**
     * Display a listing of the resource
     */
    public function index(): View
    {
        $items = $this->model->query();
        
        // Apply ordering if the model has an 'ordered' scope
        if (method_exists($this->model, 'scopeOrdered')) {
            $items = $items->ordered();
        }
        
        $items = $items->get();
        
        return view("{$this->viewPath}.index", [
            strtolower(class_basename($this->model)) . 's' => $items
        ]);
    }
    
    /**
     * Show the form for creating a new resource
     */
    public function create(): View
    {
        return view("{$this->viewPath}.create");
    }
    
    /**
     * Store a newly created resource
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $this->model->create($validated);
        
        return redirect()->route("{$this->routePrefix}.index")
            ->with('success', $this->getResourceName() . ' created successfully!');
    }
    
    /**
     * Display the specified resource
     */
    public function show(Model $model): View
    {
        return view("{$this->viewPath}.show", compact('model'));
    }
    
    /**
     * Show the form for editing the specified resource
     */
    public function edit(Model $model): View
    {
        return view("{$this->viewPath}.edit", compact('model'));
    }
    
    /**
     * Update the specified resource
     */
    public function update(Request $request, Model $model): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $model->update($validated);
        
        return redirect()->route("{$this->routePrefix}.index")
            ->with('success', $this->getResourceName() . ' updated successfully!');
    }
    
    /**
     * Remove the specified resource
     */
    public function destroy(Model $model): RedirectResponse
    {
        $model->delete();
        
        return redirect()->route("{$this->routePrefix}.index")
            ->with('success', $this->getResourceName() . ' deleted successfully!');
    }
    
    /**
     * Validate the request data
     */
    abstract protected function validateRequest(Request $request): array;
    
    /**
     * Get the resource name for messages
     */
    protected function getResourceName(): string
    {
        return class_basename($this->model);
    }
}
