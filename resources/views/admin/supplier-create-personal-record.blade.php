@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Provide personal information for register as supplier
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                @if(session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="/supplier-create" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label for="supplier_name" class="col-form-label">Supplier Mame:</label>
                                                @error('supplier_name')
                                                    <label class="form-group"
                                                        style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                                @enderror
                                                <input type="text" name="supplier_name" class="form-control"
                                                    placeholder="Supplier Mame"
                                                    value="{{ old('supplier_name') }}">
                                            </div>
                                        </div>


                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label for="supplier_phone" class="col-form-label">Supplier
                                                    Phone:</label>
                                                @error('supplier_phone')
                                                    <label class="form-group"
                                                        style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                                @enderror
                                                <input type="text" name="supplier_phone" class="form-control"
                                                    placeholder="Supplier Phone"
                                                    value="{{ old('supplier_phone') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label for="supplier_email" class="col-form-label">Supplier
                                                    Email:</label>
                                                @error('supplier_email')
                                                    <label class="form-group"
                                                        style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                                @enderror
                                                <input type="email" name="supplier_email" class="form-control"
                                                    placeholder="Supplier Email"
                                                    value="{{ old('supplier_email') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label for="supplier_address" class="col-form-label">Supplier
                                                    Address:</label>
                                                @error('supplier_address')
                                                    <label class="form-group"
                                                        style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                                @enderror
                                                <textarea rows="4" cols="80" class="form-control"
                                                    placeholder="Please insert your address"
                                                    name="supplier_address">{{ old('supplier_address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label for="supplier_description" class="col-form-label">Supplier
                                                    Description:</label>
                                                @error('supplier_description')
                                                    <label class="form-group"
                                                        style="color: #e83f3f; background-color: white;">{{ $message }}</label>
                                                @enderror
                                                <textarea rows="4" cols="80" class="form-control"
                                                    placeholder="Please insert your description"
                                                    name="supplier_description">{{ old('supplier_description') }}</textarea>
                                            </div>
                                        </div>


                                    </div>



                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                                <a href="/login" class="btn btn-danger">Back</a>
                                            </div>
                                        </div>


                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Search personal request status
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

@endsection
