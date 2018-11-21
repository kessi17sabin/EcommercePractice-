<div class="col-xs-12">
                    <div class="box">
                      <div class="box-body">

                          <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                              {!! Form::label('name') !!}
                              {!! Form::text('name',null, ['class' => 'form-control']) !!}

                              @if($errors->has('name'))
                                  <span class="help-block">{{$errors->first('name')}}</span>
                              @endif
                          </div>

                          <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                              {!! Form::label('email') !!}
                              {!! Form::text('email',null, ['class' => 'form-control']) !!}
                              @if($errors->has('email'))
                                  <span class="help-block">{{$errors->first('email')}}</span>
                              @endif
                          </div>

                          <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                              {!! Form::label('password') !!}
                              {!! Form::password('password', ['class' => 'form-control']) !!}
                              @if($errors->has('passwoord'))
                                  <span class="help-block">{{$errors->first('password')}}</span>
                              @endif
                          </div>

                          <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                              {!! Form::label('password_confirmation') !!}
                              {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                              @if($errors->has('passwoord_confirmation'))
                                  <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                              @endif
                          </div>

                          <div class="box-footer">
                              <button type="submit" class="btn btn-primary">{{$user->exists? 'update': 'save'}}</button>
                              <a href="{{route('admin_users_index')}}" class="btn btn-default">Back</a>
                          </div>
                    </div>

                    </div>


</div>
