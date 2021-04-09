<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROJECTS') }}
        </h2>
        <a href="{{route('client.projects.add')}}">Add Projects</a>
    </x-slot>
     @if(Session::has("success"))
        <div class="alert alert-success">
            {{Session::get("success")}}
        </div>
    @elseif(Session::has("failed")) 
        <div class="alert alert-danger">
            {{Session::get("failed")}}
        </div>
    @endif
   
        <div class="container">
         <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>status</th>
                <th>Details</th>
                <th>View Details</th>
                
            </tr>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->title }}</td>
                <td>{{ $value->status }}</td>
                <td>{{ $value->due_date }}</td>
                <td><a href="{{route('designer.projects.viewhistory',['id'=>$value->id])}}">View History</a></td>
                
            </tr>
            @endforeach
        </table>  
        {!! $data->links() !!} 
    </div>
   
</x-app-layout>
