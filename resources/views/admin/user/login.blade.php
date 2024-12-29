@include('admin.layout.partials.css')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main>
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-5 col-lg-4 col-xl-3 d-none d-lg-block">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvoDnYNaibBfxOtLxqWVWmUQjkoB4z8lgV-g&s"
                class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 p-5 border border-1 shadow-lg">
              <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                @csrf
                <!-- Username input -->
                <h2 class="text-center">FORM LOGIN</h2>
                <div class="form-outline mb-4">
                  <label class="form-label" for="form1Example13">Username</label>
                  <input type="text" name="username" id="form1Example13" class="form-control form-control-lg @error('username') is-invalid @enderror" required value="{{ old('username') }}" />
                  @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form1Example23">Password</label>
                  <input type="password" name="password" id="form1Example23" class="form-control form-control-lg @error('password') is-invalid @enderror" required />
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
      
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Login</button>
      
              </form>
            </div>
          </div>
        </div>
      </section>
      
</main>
