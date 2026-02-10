<div class="modal fade" id="signin" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0">

      <div class="card shadow-lg rounded-4 p-4" style="max-width:420px; width:100%; margin:auto;">


        <div class="text-center mb-3">
          <h5 class="fw-bold d-flex justify-content-center align-items-center gap-2">
            <i class="bi bi-person-fill"></i>
            Masuk sebagai Takmir
          </h5>
        </div>


        <form method="POST" action="{{ route('login') }}">
          @csrf

          {{-- Username --}}
          <div class="input-group mb-3">
            <span class="input-group-text bg-white">
              <i class="bi bi-envelope"></i>
            </span>
            <input
              type="email"
              name="email"
              class="form-control @error('email') is-invalid @enderror"
              placeholder="Email"
              value="{{ old('email') }}"
              autocomplete="email"
              required>

            @error('email', 'login')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror

          </div>

          {{-- Password --}}
          <div class="input-group mb-3">
            <span class="input-group-text bg-white">
              <i class="bi bi-lock"></i>
            </span>
            <input
              type="password"
              name="password"
              class="form-control @error('password') is-invalid @enderror"
              placeholder="Password"
              autocomplete="current-password"
              required>

            @error('password', 'login')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
            @enderror

          </div>

          {{-- Remember --}}
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              name="remember"
              id="remember"
              {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
              Ingatkan Saya
            </label>
          </div>

          <div class="alert alert-warning small d-flex align-items-start gap-2 rounded-3">
            <i class="bi bi-exclamation-triangle-fill mt-1"></i>
            <div>
              Akses ini khusus untuk takmir masjid.
              Semua aktivitas akan tercatat demi keamanan.
            </div>
          </div>

          <button type="submit"
            class="btn btn-success w-100 rounded-pill py-2 fw-semibold"
            onclick="this.disabled=true; this.form.submit();">
            Sign In
          </button>
        </form>

      </div>

    </div>
    @if ($errors->login->any())
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('signin'));
        modal.show();
      });
    </script>
    @endif

  </div>
</div>