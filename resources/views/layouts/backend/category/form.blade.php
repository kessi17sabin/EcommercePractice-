<div class="col-xs-12">
                    <div class="box">
                      <div class="box-body">

                          <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                              {!! Form::label('title') !!}
                              {!! Form::text('title',null, ['class' => 'form-control']) !!}

                              @if($errors->has('title'))
                                  <span class="help-block">{{$errors->first('title')}}</span>
                              @endif
                          </div>

                          <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                              {!! Form::label('slug') !!}
                              {!! Form::text('slug',null, ['class' => 'form-control']) !!}
                              @if($errors->has('slug'))
                                  <span class="help-block">{{$errors->first('slug')}}</span>
                              @endif
                          </div>

                          <div class="box-footer">
                              <button type="submit" class="btn btn-primary">{{$category->exists? 'update': 'save'}}</button>
                              <a href="{{route('admin_category_index')}}" class="btn btn-default">Back</a>
                          </div>
                    </div>

                    </div>


</div>
