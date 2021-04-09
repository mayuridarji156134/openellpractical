<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Details') }}
        </h2>
        <a href="{{route('client.projects')}}" class="btn btn-primary">Back</a>
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
        @if(!empty($projectdetails))
            @foreach($projectdetails as $k=>$v)
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{$v->name}} Time: {{$v->created_at}}</h5>
                    @if($v->notes!='')
                      Notes:  <p>{!! $v->notes !!}</p>
                    @endif
                    @if(isset($v->files) && count($v->files)>0)
                        <p class="card-text">See Attachment:</p>
                        @foreach($v->files as $fk=>$fv)
                            @php $filenm = explode(".",$fv->name); 
                                 $ext= end($filenm);
                            @endphp
                            @if($ext=='png'|| $ext=='jpg'|| $ext=='jpeg')
                                <div><img src="{{asset('/images/client/projectfiles/').'/'.$fv->name}}" height="50" width="50" /> </div>
                            @elseif($ext=='pdf' || $ext=='doc' || $ext=='docx' )
                                <div><a href="{{asset('/images/client/projectfiles/').'/'.$fv->name}}" target="_blank">{{$fv->name}}</a></div>
                            @else
                                <div>{{$fv->name}}</div>
                            @endif
                        @endforeach
                    @endif
                </div>
                </div>
            @endforeach
        @endif
        <div id="commentForm" style="display: none;">
            <form method="POST" action="{{ route('client.projects.addnotes',['id'=>$id]) }}" enctype="multipart/form-data" id="AddnoteForm">
            @csrf
                <div class="mt-4">
                    <x-jet-label for="notes" value="{{ __('Note') }}" />
                    <textarea id="notes" class="block mt-1 w-full" name="notes" >
                    </textarea>
                </div>
                <div class="mt-4">
                    <x-jet-label for="File" value="{{ __('Files') }}" />
                    <x-jet-input type="file" name="files[]" multiple  />
                </div>
              <button type="submit" class="btn btn-primary">Add Note & submit</button>
            </form>
        </div>
        <a href="#" class="btn btn-primary" id="AddComment">Add Notes</a>
    </div>
</x-app-layout>
<script type="text/javascript">
    //create CKediter
    ClassicEditor
            .create( document.querySelector( '#notes' ) )
            .catch( error => {
                console.error( error );
            } );
    // Display form to add comment
    $(document).on('click','#AddComment',function(){
        $('#commentForm').show();
        $(this).hide();
    });

    //Add Validation
    $(document).ready(function() {
        $("#AddnoteForm").validate({
            rules: {
                notes: "required"
            }
        });
    });
   
</script>
