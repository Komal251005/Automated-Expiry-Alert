document.addEventListener('DOMContentLoaded', () => {
    const signupButton = document.querySelector('.signup-button');
    
    signupButton.addEventListener('click', () => {
      alert('Sign up functionality will be implemented here!');
    });
  
    // Add hover effect to feature cards
    const featureCards = document.querySelectorAll('.feature-card');
    
    featureCards.forEach(card => {
      card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-5px)';
        card.style.transition = 'transform 0.3s ease';
      });
      
      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
      });
    });
  });