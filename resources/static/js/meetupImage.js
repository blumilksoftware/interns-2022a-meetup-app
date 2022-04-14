const imageInput = document.getElementById('image-input');
const image = document.getElementById('image');

imageInput.addEventListener('change', (e) => {
  image.src = URL.createObjectURL(e.target.files[0]);
  image.setAttribute('width', '400px');
  image.setAttribute('height', '200px')
})
