<x-app>
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2>Editar Usuario</h2>
            </div>
            <div class="card-body">
                <form action="{{route('user.edit.put',['user' => $user->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- antes de pasarle los roles
                        <x-user.form-user :user="$user" /> --}}
                    <x-user.form-user :user="$user" :roles="$roles"/>
                </form>
            </div>
        </div>
    </section>
</x-app>
