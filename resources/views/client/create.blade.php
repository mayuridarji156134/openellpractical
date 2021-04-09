<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROJECTS') }}
        </h2>
         <a href="{{route('client.projects')}}">Back</a>
    </x-slot>
    
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!-- <x-jet-authentication-card-logo /> -->
        </x-slot>
        <form method="POST" action="{{ route('client.projects.store') }}" enctype="multipart/form-data" id="CreateProjectForm">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" autofocus    />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Description') }}" />
                <textarea id="description" class="block mt-1 w-full" name="description" >
                </textarea>
            </div>
            <div class="mt-4">
                <x-jet-label for="due_date" value="{{ __('Due Date') }}" />
                <x-jet-input id="due_date" class="block mt-1 w-full" type="date" name="due_date"  />
            </div>
            <div class="mt-4">
                <x-jet-label for="File" value="{{ __('Files') }}" />
                <x-jet-input type="file" name="files[]" multiple  />
            </div>
            <div class="mt-4">
                <x-jet-label for="assign_to" value="{{ __('Assign To') }}" />
                <select id="assign_to" class="block mt-1 w-full" name="assign_to" >
                    <option value="">Select Assignee</option>
                    @foreach($designer as $k=>$v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Create') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
<script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script type="text/javascript">
        
        $(document).ready(function() {
            $("#CreateProjectForm").validate({
                rules: {
                    title: "required",
                    assign_to: "required",
                    due_date:  "required"
                }
            });
        });
   
</script>
