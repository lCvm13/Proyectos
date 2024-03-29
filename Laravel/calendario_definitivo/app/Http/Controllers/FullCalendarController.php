<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class FullCalendarController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        
        if($request->ajax()) {
       
             $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->where('user_id', '=' ,$request->user()->id)
                       ->get(['id', 'title', 'start', 'end','user_id']);
  
             return response()->json($data);
        }
       
        return view('fullcalendar');
    }
 
    
    public function ajax(Request $request): JsonResponse
    {
       
        switch ($request->type) {
            
           case 'add':
            
            
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
                  'user_id' => $request->user()->id
              ]);
             
              return response()->json($event);
              
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
          case 'change':
            $event = Event::find($request->id)->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,

            ]);
            return response()->json($event);
            break;
        }
    }
}