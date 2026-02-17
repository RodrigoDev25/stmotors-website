(function () {
  'use strict';

  const uploadArea    = document.getElementById('upload-area');
  const uploadInput   = document.getElementById('foto');
  const uploadPreview = document.getElementById('upload-preview');
  const uploadPlaceholder = document.getElementById('upload-placeholder');
  const previewImg    = document.getElementById('preview-img');
  const removeBtn     = document.getElementById('upload-remove');

  if (!uploadArea || !uploadInput) return;

  function showPreview(file) {
    if (!file || !file.type.startsWith('image/')) return;

    const reader = new FileReader();
    reader.onload = (e) => {
      previewImg.src = e.target.result;
      uploadPreview.hidden = false;
      uploadPlaceholder.hidden = true;
    };
    reader.readAsDataURL(file);
  }

  function clearPreview() {
    uploadInput.value = '';
    previewImg.src = '';
    uploadPreview.hidden = true;
    uploadPlaceholder.hidden = false;
  }

  uploadInput.addEventListener('change', () => {
    if (uploadInput.files[0]) showPreview(uploadInput.files[0]);
  });

  if (removeBtn) {
    removeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      clearPreview();
    });
  }

  // Drag and drop
  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file) {
      const dt = new DataTransfer();
      dt.items.add(file);
      uploadInput.files = dt.files;
      showPreview(file);
    }
  });

})();