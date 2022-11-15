<script>
    function delLike(e) {
        e.target.disabled = true;
        const id = e.target.getAttribute('id');
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('/api/user').then(response => {
                axios.post('/api/admin_del_like/' + id).then(response => {
                    if (response.status === 'success') {
                        e.target.parentNode.parentNode.parentNode.removeChild(e.target.parentNode.parentNode)
                    } else {
                        e.target.disabled = false;
                    }
                    alert(response.data.message);
                }).catch(function (error) {
                    // handle error
                    e.target.disabled = false;
                    if (error.response.status === 401) {
                        window.location = "/login";
                    } else {
                        console.log(error);
                        e.target.textContent = 'ERROR';
                    }
                });
            }).catch(function (error) {
                // handle error
                if (error.response.status === 401) {
                    window.location = "/login";
                } else {
                    e.target.disabled = false;
                    console.log(error);
                    e.target.textContent = 'Error';
                }
            });
        });
    }
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.links.store') }}" method="post">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">{{ __('Name') }}</label>
                            <input name="name" type="text" class="form-control" id="formGroupExampleInput"
                                   placeholder="Example input placeholder">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">{{ __('URI') }}</label>
                            <input name="url_address" type="url" class="form-control" id="formGroupExampleInput2"
                                   placeholder="Another input placeholder">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput3" class="form-label">{{ __('Description') }}</label>
                            <textarea name="description" type="text" class="form-control" id="formGroupExampleInput2"
                                      placeholder="Another input placeholder">
                            </textarea>
                        </div>
                        @csrf
                        <button href="{{ route('admin.links.create') }}" type="submit" class="btn btn-outline-success">
                            {{ __('Create') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
