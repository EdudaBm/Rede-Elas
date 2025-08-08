const stars = document.querySelectorAll('.star');
const result = document.getElementById('rating-result');
let selectedRating = 0;

stars.forEach(star => {
  star.addEventListener('mouseover', () => {
    const value = parseInt(star.getAttribute('data-value'));
    highlightStars(value);
  });

  star.addEventListener('mouseout', () => {
    highlightStars(selectedRating);
  });

  star.addEventListener('click', () => {
    selectedRating = parseInt(star.getAttribute('data-value'));
    result.textContent = `Você avaliou com ${selectedRating} estrela${selectedRating > 1 ? 's' : ''}.`;
  });
});

function highlightStars(rating) {
  stars.forEach(star => {
    const value = parseInt(star.getAttribute('data-value'));
    if (value <= rating) {
      star.classList.add('selected');
    } else {
      star.classList.remove('selected');
    }
  });
}
