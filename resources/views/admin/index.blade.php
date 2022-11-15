<script>
    function delLike(e) {
        e.target.disabled = true;
        const id = e.target.getAttribute('id');
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('/api/user').then(response => {
                axios.post('/api/admin_del_like/' + id).then(response => {
                    console.log(response)
                    if (response.data.status === 'success') {
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
                    <a href="{{ route('admin.links.create') }}" type="button" class="btn btn-outline-success">
                        {{ __('Create') }}
                    </a>
                    <x-jstable>
                        @foreach($links as $link)
                            <tr>
                                <td>{{ $link->id }}</td>
                                <td>{{ $link->name }}</td>
                                <td>{{ $link->description }}</td>
                                <td><a href="{{ $link->url_address }}" target="_blank">{{ $link->name }}</a></td>
                                <td>
                                    <button @click="delLike" id="{{ $link->id }}"
                                            class="flex items-center hover:border-gray-300 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out hover:opacity-90 hover:-rotate-3">
                                        {{ __('Delete') }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </x-jstable>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
