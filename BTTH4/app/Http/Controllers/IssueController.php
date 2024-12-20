<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::with('computer') 
            ->paginate(10);
        return view(view: 'issues.index', data: compact(var_name: 'issues')); 
    }
    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:255',
            'reported_date' => 'required|date',
            'description' => 'required|string|max:1000', 
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);
    
        Issue::create([
            'computer_id' => $request->computer_id,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'description' => $request->description,
            'urgency' => $request->urgency,
            'status' => $request->status,
        ]);
    
        return redirect()->route('issues.index')->with('success', 'Issue created successfully!');
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $computers = Computer::all(); 
        
        $issue->reported_date = Carbon::parse($issue->reported_date);
    
        return view('issues.edit', compact('issue', 'computers'));
    }

    public function update(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
    
        $issue->update([
            'computer_id' => $request->computer_id,
            'reported_by' => $request->reported_by,
            'reported_date' => $request->reported_date,
            'description' => $request->description,  
            'urgency' => $request->urgency,
            'status' => $request->status,
        ]);
    
        return redirect()->route('issues.index')->with('success', 'Issue updated successfully!');
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return redirect()->route('issues.index');
    }
}
