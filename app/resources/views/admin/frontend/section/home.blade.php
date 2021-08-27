@extends('include.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
									<div class="card-header">
										<div class="card-title">{{__($page_title)}}</div>

									</div>
									<div class="card-body">
                <form action="{{ route('admin.frontend.homeContent.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input type="text" class="form-control " placeholder="Write Title" name="title" value="{{@$post->value->title }}" />
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Details </label>
                                    <textarea name="details" class="form-control nicEdit" placeholder="Write content" cols="30" rows="5">{{ @$post->value->details }}</textarea>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <label>Header Image </label><br>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{asset('assets/images/frontend/'.@$post->value->image)}}" alt="...">

                                    </div>
                                    <br><br>
                                   <div class="form-group"><div class="custom-file"><input type="file" type="file" name="image" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Image</label></div></div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>
                            <hr>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Header</label>
                                    <input name="abouthead" class="form-control nicEdit" value="{{ @$post->value->abouthead }}" placeholder="Write content">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Sub-Header</label>
                                    <input name="aboutsubhead" class="form-control nicEdit" value="{{ @$post->value->aboutsubhead }}" placeholder="Write content">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>About Image </label><br>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{asset('assets/images/frontend/'.@$post->value->aboutimage)}}" alt="...">

                                    </div>
                                    <br><br>
                                   <div class="form-group"><div class="custom-file"><input type="file" type="file" name="aboutimage" accept="image/*" class="custom-file-input" ><label class="custom-file-label">Upload Image</label></div></div>
                                </div>
                                @if ($errors->has('aboutimage'))
                                    <div class="error">{{ $errors->first('aboutimage') }}</div>
                                @endif

                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Body</label>
                                    <textarea name="aboutbody" class="form-control nicEdit" placeholder="Write content" cols="30" rows="5">{{ @$post->value->aboutbody }}</textarea>
                                </div>
                            </div>
                            <hr>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Problem Header</label>
                                    <input name="problemheader" class="form-control nicEdit" value="{{ @$post->value->problemheader }}" placeholder="Write content">
                                </div>
                            </div>

                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Getting Started</label>
                                    <input name="start" class="form-control nicEdit" value="{{ @$post->value->step }}" placeholder="Write content">
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Step 1</label>
                                    <input name="step1" class="form-control nicEdit" value="{{ @$post->value->step1 }}" placeholder="Write content">
                                </div>
                            </div>





                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Step 2</label>
                                    <input name="step2" class="form-control nicEdit" value="{{ @$post->value->step2 }}" placeholder="Write content">
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Step 3</label>
                                    <input name="step3" class="form-control nicEdit" value="{{ @$post->value->step3 }}" placeholder="Write content">
                                </div>
                            </div>



                           


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Statistics Header</label>
                                    <input name="g1" class="form-control nicEdit" value="{{ @$post->value->g1 }}" placeholder="Write content">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Statistics Sub Header</label>
                                    <input name="g2" class="form-control nicEdit" value="{{ @$post->value->g2 }}" placeholder="Write content">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Regular User</label>
                                    <input name="g4" class="form-control nicEdit" value="{{ @$post->value->g4 }}" placeholder="Write content">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Transactions made</label>
                                    <input name="g5" class="form-control nicEdit" value="{{ @$post->value->g5 }}" placeholder="Write content">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Awards Winning</label>
                                    <input name="g6" class="form-control nicEdit" value="{{ @$post->value->g6 }}" placeholder="Write content">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Year of Experience</label>
                                    <input name="g7" class="form-control nicEdit" value="{{ @$post->value->g7 }}" placeholder="Write content">
                                </div>
                            </div>



                           






                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-block btn-primary mr-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div></div></div></div>
@endsection
