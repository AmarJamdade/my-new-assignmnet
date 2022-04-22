@extends('layouts.app-main')

@section('css')
@endsection

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Edit</h3>
              </div>
              <form action="{{ route('edit-product',[$product->id]) }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_sku">Product SKU</label>
                        <input type="text" name="product_sku" class="form-control {{ $errors->has('product_sku') ? ' is-invalid' : '' }}" id="product_sku" placeholder="Enter Product SKU" value="{{ old('product_sku',$product->product_sku) }}" readonly>
                        @if ($errors->has('product_sku'))
                          <span class="error invalid-feedback">{{ $errors->first('product_sku') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_name"> Product Name</label>
                        <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}" id="product_name" placeholder="Enter Product Name" value="{{ old('product_name',$product->product_name) }}">
                        @if ($errors->has('product_name'))
                          <span class="error invalid-feedback">{{ $errors->first('product_name') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }} custom-select">
                          <option value="">Select one</option>
                          @foreach($category as $cat)
                            <option value="{{ $cat->id }}"@if(old('category',$product->category_id) == $cat->id) selected @endif>{{ $cat->category_name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('category'))
                          <span class="error invalid-feedback">{{ $errors->first('category') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }} custom-select">
                          <option value="">Select one</option>
                          <option value="0" @if(old('status',$product->status) == 0) selected @endif>Active</option>
                          <option value="1" @if(old('status',$product->status) == 1) selected @endif>Inactive</option>
                        </select>
                        @if ($errors->has('status'))
                          <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                        @endif
                      </div>
                    </div>
                    {{-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                  <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
@endsection