<div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Product <a href="{{ route('product.create') }}"
                            class="btn btn-primary btn-rounded btn-sm float-end text-white">Add Product</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No#</th>
                                    <th>Name</th>
                                    <th>slug</th>
                                    <th>brand</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>{{ $product->brand }}</td>
                                        <td><a href="{{ url('admin/category/' . $product->id . '/edit') }}"
                                                class="btn btn-primary btn-rounded btn-sm text-white">Edit</a>
                                            <a href="#" wire:click="deleteCatagory({{ $product->id }})"
                                                class="btn btn-danger btn-rounded btn-sm text-white"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Brand Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
