@extends('layouts.app-main')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category Edit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category Edit</li>
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
              <h3 class="card-title">Category Edit</h3>
            </div>
            <form action="{{ route('edit-category',[$category->id]) }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <input type="text" name="category_name" class="form-control {{ $errors->has('category_name') ? ' is-invalid' : '' }}" id="category_name" value="{{ old('category_name',$category->category_name) }}" placeholder="Enter Category Name">
                      @if ($errors->has('category_name'))
                        <span class="error invalid-feedback">{{ $errors->first('category_name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputStatus">Status</label>
                      <select id="inputStatus" name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}">
                        <option value="">Select one</option>
                        <option value="0" @if(old('status',$category->status) == "0") selected @endif>Active</option>
                        <option value="1" @if(old('status',$category->status) == "1") selected @endif>Inactive</option>
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