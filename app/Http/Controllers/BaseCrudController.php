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
    
    
    public function index(): View
    {
        $items = $this->model->query();

        if (method_exists($this->model, 'scopeOrdered')) {
            $items = $items->ordered();
        }
        
        $items = $items->get();
        
        return view("{$this->viewPath}.index", [
            strtolower(class_basename($this->model)) . 's' => $items
        ]);
    }
    
    
    public function create(): View
    {
        return view("{$this->viewPath}.create");
    }
    
    
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $this->model->create($validated);
        
        return redirect()->route("{$this->routePrefix}.index")
            ->with('success', $this->getResourceName() . ' created successfully!');
    }
    
    
    public function show(Model $model): View
    {
        return view("{$this->viewPath}.show", compact('model'));
    }
    
    
    public function edit(Model $model): View
    {
        return view("{$this->viewPath}.edit", compact('model'));
    }
    
    
    public function update(Request $request, Model $model): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $model->update($validated);
        
        return redirect()->route("{$this->routePrefix}.index")
            ->with('success', $this->getResourceName() . ' updated successfully!');
    }
    
    
    public function destroy(Model $model): RedirectResponse
    {
        $model->delete();
        
        return redirect()->route("{$this->routePrefix}.index")
            ->with('success', $this->getResourceName() . ' deleted successfully!');
    }
    
    
    abstract protected function validateRequest(Request $request): array;
    
    
    protected function getResourceName(): string
    {
        return class_basename($this->model);
    }
}
