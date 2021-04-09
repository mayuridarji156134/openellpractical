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
                <th>Details</th>
                <th>View Details</th>
                <th>Mark as completed</th>
            </tr>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->title }}</td>
                <td>{{ $value->due_date }}</td>
                <td><a href="{{route('client.projects.viewhistory',['id'=>$value->id])}}">View Details</a></td>
                <td>
                    @if($value->status!='completed')
                    <button pid="{{$value->id}}" id="markasComplete">Mark as Complete</button>
                    @else
                    <button>Completed</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>  
        {!! $data->links() !!} 
    </div>
</x-app-layout>
<script type="text/javascript">
$(document).on('click','#markasComplete',function(){
    var pid= $(this).attr('pid');
    $.ajax({
        url: "{{ route('client.projects.changestatus') }}",
        type:'POST',
        headers:{ 'X-CSRF-Token' : jQuery('meta[name=csrf-token]').attr('content') },
        data : {'pid':pid},
        success: function(data)
        {  
            if(data=='true'){
                alert('Projects is completed')
                $('#markasComplete').text('Completed')
            }
        }
    });
});
    
</script>