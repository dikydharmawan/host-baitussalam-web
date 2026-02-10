@props([
'title' => 'Galeri Foto',
'images' => [],
'section' => ''
])

<h6 class="fw-semibold mb-3">{{ $title }}</h6>

<div class="row g-4">

  @foreach($images as $img)
  <div class="col-md-3 col-sm-6">
    <div class="gallery-card">
      <img src="{{ asset('storage/'.$img->image_path) }}"
        class="w-100 gallery-img">

      <p class="text-muted mb-0">
        {{ $img->caption }}
      </p>

      @auth
      @if(auth()->user()->canManageGallery())
      <small class="text-muted">
        Diupload oleh {{ optional($img->user)->name ?? 'Takmir' }}
      </small>
      @endif
      @endauth
    </div>
  </div>
  @endforeach


  {{-- SLOT TAMBAH --}}
  @auth
  @if(auth()->user()->canManageGallery())
  <div class="col-md-3 col-sm-6">
    <div class="gallery-card gallery-add" onclick="openUploadForm()">
      <div class="gallery-plus">
        <i class="bi bi-plus-lg"></i>
      </div>
    </div>
  </div>
  @endif
  @endauth

</div>

{{-- MODAL UPLOAD --}}
@auth
@if(auth()->user()->canManageGallery())
<div class="modal fade" id="uploadModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST"
      action="{{ route('galeri.upload') }}"
      enctype="multipart/form-data"
      class="modal-content">
      @csrf

      <input type="hidden" name="section" value="{{ $section }}">

      <div class="modal-header">
        <h5 class="modal-title">Upload Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
          <input type="text" name="caption"
            class="form-control"
            placeholder="Keterangan gambar"
            required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal">
          Batal
        </button>

        <button type="submit" class="btn btn-success">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openUploadForm() {
    const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
  }
</script>
@endif
@endauth