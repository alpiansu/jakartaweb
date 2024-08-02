<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubService;
use App\Models\Counter;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    public function index()
    {
        $subservice = SubService::where('id', 1)->first();
        $services = Service::where('id_sub_services', 1)->get();
        $counters = Counter::where('id_sub_services', 1)->get();

        return view('admin.service.index', compact('services', 'counters', 'subservice'));
    }

    public function updateSubService(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
        ]);

        try {
            $subservice = SubService::where('id', 1)->first();
            $subservice->update($request->only(['heading', 'sub_heading']));

            return redirect()->route('admin.service.index')->with('success', 'SubService updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update SubService: ' . $e->getMessage()]);
        }
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_class' => 'required|string|max:255',
        ]);

        try {
            $data = $request->only(['title', 'description', 'icon_class']);
            $data['id_sub_services'] = 1;

            Service::create($data);

            return redirect()->route('admin.service.index')->with('success', 'Service added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add service: ' . $e->getMessage()]);
        }
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_class' => 'required|string|max:255',
        ]);

        try {
            $service = Service::findOrFail($id);
            $data = $request->only(['title', 'description', 'icon_class']);
            $data['id_sub_services'] = 1;

            $service->update($data);
            return redirect()->route('admin.service.index')->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update service: ' . $e->getMessage()]);
        }
    }

    public function destroyService($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();

            return redirect()->route('admin.service.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete service: ' . $e->getMessage()]);
        }
    }

    public function storeCounter(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:175',
            'subtitle' => 'required|string|max:255',
        ]);

        try {
            $data = $request->only(['value', 'subtitle']);
            $data['id_sub_services'] = 1;

            Counter::create($data);

            return redirect()->route('admin.service.index')->with('success', 'Counter added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add counter: ' . $e->getMessage()]);
        }
    }

    public function updateCounter(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:175',
            'subtitle' => 'required|string|max:255',
        ]);

        try {
            $counter = Counter::findOrFail($id);
            $data = $request->only(['value', 'subtitle']);
            $data['id_sub_services'] = 1;
            $counter->update($data);

            return redirect()->route('admin.service.index')->with('success', 'Counter updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update counter: ' . $e->getMessage()]);
        }
    }

    public function destroyCounter($id)
    {
        try {
            $counter = Counter::findOrFail($id);
            $counter->delete();

            return redirect()->route('admin.service.index')->with('success', 'Counter deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete counter: ' . $e->getMessage()]);
        }
    }
}
