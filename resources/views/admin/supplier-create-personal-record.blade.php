@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Create Supplier</h5>
                    </div>
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
                                        <label for="supplier_phone" class="col-form-label">Supplier Phone:</label>
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
                                        <label for="supplier_email" class="col-form-label">Supplier Email:</label>
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
                                        <label for="supplier_address" class="col-form-label">Supplier Address:</label>
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
        </div>
    </div>


</div>

@endsection
