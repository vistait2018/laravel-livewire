<div>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">users</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->


    <div class="content">
        <div class="container-fluid ">
            {{-- @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fa fa-check-circle mr-1"></i> Success! </strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif --}}
            <div class="row">

                <div class="col-sm-10 mr-3 ml-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" wire:click.prevent="addNew">
                                    <i class="fa fa-plus-circle mr-2 text-white"> </i>
                                    Add New User
                                </button>
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user )


                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a wire:click.prevent="edit({{ $user }})">
                                                <i class="fa fa-edit text-info mr-2"></i>
                                            </a>
                                            <a wire:click.prevent="confirmDelete({{ $user->id }})">
                                                <i class="fa fa-trash text-danger nr-2"></i>

                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <!-- Add User Modal-->
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">

                        @if($showEditModal === false)
                        <span>New User</span>
                        @else
                        <span> Edit User</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div>
                        @if (session()->has('message'))
                        <div class="alert alert-success mt-2 mb-2">
                            {{ session('message') }}
                        </div>
                        @endif
                    </div>
                    <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" wire:model.defer="state.name"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                aria-describedby="nameHelp" placeholder="Enter name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" wire:model.defer="state.email"
                                class="form-control @error('email') is-invalid @enderror" id=" email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model.defer="state.password"
                                class="form-control @error('password') is-invalid @enderror" id=" password"
                                placeholder="Password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group @error('password_confirmation') is-invalid @enderror">
                            <label for=" password_confirmation">Confirm Password</label>
                            <input type="password" wire:model.defer="state.password_confirmation" class="form-control"
                                id="state.password_confirmation" placeholder="Confirm Password">

                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-times mr-1"></i>Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        @if($showEditModal === false)
                        <span>Save</span>
                        @else
                        <span> Save Changes</span>
                        @endif</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete User Modal-->
    <!-- Modal -->
    <div class="modal fade" id="confirmationForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationForm">
                        Delete User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <i class="fa fa-exclamation"></i>Are you sure you want to delete User?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times mr-1"></i>Cancel</button>
                        <button wire:click.prevent="deleteUser" type="submit" class="btn btn-danger"><i
                                class="fa fa-trash mr-1"></i>
                            Delete User
                    </div>
                    </form>
                </div>
            </div>
        </div>

        confirmationForm
    </div>
