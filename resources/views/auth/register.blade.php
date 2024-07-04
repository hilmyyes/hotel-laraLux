
            
           @extends('layouts.app')

           @section('content')
             <div class="container h-100">
               <div class="row d-flex justify-content-center align-items-center h-100">
                 <div class="col-lg-12 col-xl-11">
                   <div class="card text-black" style="border-radius: 25px;">
                     <div class="card-body p-md-5">
                       <div class="row justify-content-center">
                         <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
           
                           <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color: blue">Registrasi</p>
           
                           <form method="POST" action="{{ route('register') }}" class="mx-1 mx-md-4">
                             @csrf
           
                             <div class="d-flex flex-row align-items-center mb-4">
                               <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                               <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="name">Your Name</label>
                                 <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                 @error('name')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                               </div>
                             </div>
           
                             <div class="d-flex flex-row align-items-center mb-4">
                               <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                               <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="email">Your Email</label>

                                 <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
                                 @error('email')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                               </div>
                             </div>
           
                             <div class="d-flex flex-row align-items-center mb-4">
                               <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                               <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="password">Password</label>

                                 <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                                 @error('password')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                               </div>
                             </div>
           
                             <div class="d-flex flex-row align-items-center mb-4">
                               <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                               <div class="form-outline flex-fill mb-0">
                                <label class="form-label" for="password-confirm">Repeat your password</label>

                                 <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                               </div>
                             </div>
           
                             <div class="d-flex flex-row align-items-center mb-4">
                               <i class="fas fa-user-tag fa-lg me-3 fa-fw"></i>
                               <div class="form-outline flex-fill mb-0">
                                 <label class="form-label" for="role">Role</label>
                                 <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                   <option value="guest">Guest</option>
                                 </select>
                                 @error('role')
                                   <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                               </div>
                             </div>
           
    
           
                             <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                               <button type="submit" class="btn btn-primary btn-lg" style="font-weight: bold;padding-left: 7rem; padding-right: 7rem;">Register</button>
                             </div>
           
                             <input type="hidden" id="pin_confirmation" name="pin_confirmation" value="1234" />

                           </form>
           
                         </div>
                         <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                           <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </section>
           @endsection
           