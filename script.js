// Signup validation
function validateSignupForm(){
    const nameValid = validateSignupName();
    const phoneValid = validateSignupPhone();
    const emailValid = validateSignupEmail();
    const passwordValid = validateSignupPass();
    const repasswordValid = validateSignupRepass();
    return nameValid && phoneValid && emailValid && passwordValid && repasswordValid;
}
function validateSignupName() {
    const name = document.getElementById('signup-name').value;
    const regex = /^[A-Za-z\s-]+$/;
    if (!regex.test(name)) {
        document.getElementById('nameError').innerText = 'Invalid input! Name must contain only letters, hyphens, and whitespaces.';
        return false; 
    } else {
        document.getElementById('nameError').innerText = '';
    return true; 
    }
}
function validateSignupPhone() {
    const phone = document.getElementById('signup-phone').value.trim();
    const regex = /^\+?(\d[\d -]{7,19}\d|\d{8,15})$/;

    if (!regex.test(phone)) {
        document.getElementById('phoneError').innerText = 
            'Invalid phone number! Please enter a valid phone number with 8 to 15 digits.';
        return false;
    } else {
        document.getElementById('phoneError').innerText = '';
        return true;
    }
}
function validateSignupEmail() {
    const email = document.getElementById('signup-email').value;
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(email)) {
        document.getElementById('emailError').innerText = 'Invalid email entered! Please enter a valid email address.';
        return false;
    } else {
        document.getElementById('emailError').innerText = '';
        return true;
    }
}
function validateSignupPass() {
    const password = document.getElementById('signup-password').value; 
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
    if (!regex.test(password)){
        document.getElementById('passwordError').innerHTML = 'Invalid input! Password must be:<br>- At least 8 characters long<br>- Contain at least 1 uppercase letter<br>- Contain at least 1 lowercase letter<br>- Contain at least 1 number';
        return false; 
    } else {
        document.getElementById('passwordError').innerText = '';
        return true; 
    }
}
function validateSignupRepass() {
    const password = document.getElementById('signup-password').value;
    const rePassword = document.getElementById('signup-confirm-password').value;
    if (password !== rePassword) {
        document.getElementById('repasswordError').innerText = 'Passwords do not match!';
        return false;
    } else {
        document.getElementById('repasswordError').innerText = '';
        return true;
    }
}


//login validation
function validateLoginForm() {
    const emailValid = validateLoginEmail();
    const passValid = validateLoginPass();
    return emailValid && passValid;
}
function validateLoginEmail() {
    const email = document.getElementById('login-email').value;
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(email)) {
        document.getElementById('loginEmailError').innerText = 'Invalid Email Entered! Please enter a valid email address.';
        return false;
    } else {
        document.getElementById('loginEmailError').innerText = '';
        return true;
    }
}
function validateLoginPass() {
    const password = document.getElementById('login-password').value; 
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
    if (!regex.test(password)){
        document.getElementById('loginPasswordError').innerHTML = 'Invalid input! Password must be:<br>- At least 8 characters long<br>- Contain at least 1 uppercase letter<br>- Contain at least 1 lowercase letter<br>- Contain at least 1 number';
        return false; 
    } else {
        document.getElementById('loginPasswordError').innerText = '';
        return true; 
    }
}


//Forgot Password Validation
function validateForgotPasswordForm() {
    const emailValid = validateForgotEmail();
    const isPasswordValid = validateNewPass();
    const isRepassValid = validateNewRepass();
    return emailValid && isPasswordValid && isRepassValid;
}
function validateForgotEmail() {
    const email = document.getElementById('forgot-email').value; // Make sure input ID is 'forgot-email' in HTML
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(email)) {
        document.getElementById('loginEmailError2').innerText = 'Invalid Email Entered! Please enter a valid email address.';
        return false;
    } else {
        document.getElementById('loginEmailError2').innerText = '';
        return true;
    }
}
function validateNewPass() {
    const password = document.getElementById('new-password').value; 
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
    if (!regex.test(password)){
        document.getElementById('passwordError2').innerHTML = 'Invalid input! Password must be:<br>- At least 8 characters long<br>- Contain at least 1 uppercase letter<br>- Contain at least 1 lowercase letter<br>- Contain at least 1 number';
        return false; 
    } else {
        document.getElementById('passwordError2').innerText = '';
        return true; 
    }
}
function validateNewRepass() {
    const password = document.getElementById('new-password').value;
    const rePassword = document.getElementById('new-repassword').value;

    if (password !== rePassword) {
        document.getElementById('repasswordError2').innerText = 'Passwords do not match!';
        return false;
    } else {
        document.getElementById('repasswordError2').innerText = '';
        return true;
    }
}


// Password Visibility
function PasswordVisibility(inputId, icon) {
    var input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
//signup page
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('password-notvisible').addEventListener('click', function() {
        PasswordVisibility('signup-password', this);
    });
    document.getElementById('confirmpassword-notvisible').addEventListener('click', function() {
        PasswordVisibility('signup-confirm-password', this);
    });
});
//login page
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('loginpassword-notvisible').addEventListener('click', function() {
        PasswordVisibility('login-password', this);
    });
});
//forgotpassword page
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('newpassword-notvisible').addEventListener('click', function() {
        PasswordVisibility('new-password', this);
    });
    document.getElementById('newrepassword-notvisible').addEventListener('click', function() {
        PasswordVisibility('new-repassword', this);
    });
});


// // Homepage Hero Slider Section
const slides = document.querySelectorAll('.slide');
const pagination = document.getElementById('pagination');
let current = 0;
let autoSlideInterval = setInterval(nextSlide, 5000);

// Function to show slide based on index
function showSlide(index) {
    slides[current].classList.remove('active');
    const dots = document.querySelectorAll('.pagination button');
    dots[current].classList.remove('active');
    current = (index + slides.length) % slides.length;slides[current].classList.add('active');
    dots[current].classList.add('active');
}
// Function to move to next slide
function nextSlide() {
    showSlide(current + 1);
}
// Function to move to previous slide
function prevSlide() {
    showSlide(current - 1);
}
// Function to create pagination dots dynamically
function createPagination() {
    for (let i = 0; i < slides.length; i++) {
        const dot = document.createElement('button');
        dot.addEventListener('click', () => {
            showSlide(i);
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, 5000); // Restart auto slide
        });
        pagination.appendChild(dot);
    }
}
// Initialize pagination
createPagination();
// Set initial active dot
const dots = document.querySelectorAll('.pagination button');
dots[current].classList.add('active');
// Reset auto-slide timer when clicking arrows or pagination
document.querySelectorAll('.arrow').forEach(arrow => {
    arrow.addEventListener('click', () => {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(nextSlide, 5000);
    });
});


// Homepage Impact Stats Section
const counters = document.querySelectorAll('.count');
let started = false;

function animateCounters() {
  if (started) return;
  
  const section = document.querySelector('.impact-stats');
  const sectionTop = section.offsetTop;
  const triggerPoint = window.scrollY + window.innerHeight;

  if (triggerPoint > sectionTop) {
    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      let count = 0;
      const increment = target / 200;

      function updateCount() {
        count += increment;
        if (count < target) {
          counter.innerText = Math.ceil(count);
          requestAnimationFrame(updateCount);
        } else {
          counter.innerText = target;
        }
      }
      updateCount();
    });
    started = true;
  }
}
window.addEventListener('scroll', animateCounters);


//Homepage Testimonial
const slideTrack = document.getElementById('slideTrack');
  const secondPagination = document.getElementById('secondPagination');
  const totalSlides = 5; // Update this if dynamic
  let currentIndex = 0;
  let slidesPerView = getSlidesPerView();
  let autoSlideInterval2 = setInterval(nextTestimonialSlide, 4000);

  function getSlidesPerView() {
    if (window.innerWidth <= 600) return 1;
    if (window.innerWidth <= 992) return 2;
    return 3;
  }
  function updateTestimonialPagination() {
    secondPagination.innerHTML = '';
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement('span');
      dot.className = 'slider-dot' + (i === currentIndex ? ' active' : '');
      dot.addEventListener('click', () => goToTestimonialSlide(i));
      secondPagination.appendChild(dot);
    }
  }
  function getTestimonialSlideWidth() {
    return slideTrack.querySelector('.slide-testimonial').offsetWidth;
  }
  function goToTestimonialSlide(index) {
    currentIndex = index;
    slideTrack.style.transition = 'transform 0.5s ease-in-out';
    slideTrack.style.transform = `translateX(-${getTestimonialSlideWidth() * currentIndex}px)`;
    updateTestimonialPagination();
  }
  function nextTestimonialSlide() {
    currentIndex++;
    slideTrack.style.transition = 'transform 0.5s ease-in-out';
    slideTrack.style.transform = `translateX(-${getTestimonialSlideWidth() * currentIndex}px)`;

    if (currentIndex >= totalSlides) {
      setTimeout(() => {
        slideTrack.style.transition = 'none';
        currentIndex = 0;
        slideTrack.style.transform = `translateX(0px)`;
        updateTestimonialPagination();
      }, 510);
    } else {
      updateTestimonialPagination();
    }
  }
  function prevTestimonialSlide() {
    if (currentIndex === 0) {
      slideTrack.style.transition = 'none';
      currentIndex = totalSlides;
      slideTrack.style.transform = `translateX(-${getTestimonialSlideWidth() * currentIndex}px)`;
      setTimeout(() => {
        slideTrack.style.transition = 'transform 0.5s ease-in-out';
        currentIndex--;
        slideTrack.style.transform = `translateX(-${getTestimonialSlideWidth() * currentIndex}px)`;
        updateTestimonialPagination();
      }, 20);
    } else {
      currentIndex--;
      slideTrack.style.transition = 'transform 0.5s ease-in-out';
      slideTrack.style.transform = `translateX(-${getTestimonialSlideWidth() * currentIndex}px)`;
      updateTestimonialPagination();
    }
  }
  document.querySelector('.slider-arrow.right').addEventListener('click', () => {
    clearInterval(autoSlideInterval2);
    nextTestimonialSlide();
    autoSlideInterval2 = setInterval(nextTestimonialSlide, 4000);
  });
  document.querySelector('.slider-arrow.left').addEventListener('click', () => {
    clearInterval(autoSlideInterval2);
    prevTestimonialSlide();
    autoSlideInterval2 = setInterval(nextTestimonialSlide, 4000);
  });
  window.addEventListener('resize', () => {
    slidesPerView = getSlidesPerView();
    goToTestimonialSlide(0);
  });
  updateTestimonialPagination();


// // Donate Campaign Share Button
function shareOnFacebook() {
  const url = encodeURIComponent(window.location.href);
  const text = encodeURIComponent("Support this campaign for learning and education!");
  window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${text}`, '_blank');
}
function shareOnWhatsApp() {
  const url = encodeURIComponent(window.location.href);
  const message = `Support this campaign for learning and education: ${url}`;
  window.open(`https://wa.me/?text=${encodeURIComponent(message)}`, '_blank');
}
function copyCampaignLink() {
  navigator.clipboard.writeText(window.location.href)
    .then(() => alert('Link copied! Paste it into your Instagram bio or story.'))
    .catch(() => alert('Failed to copy link.'));
}


// FAQ section (right icon)
function toggleAnswer(answerId, button) {
    const answer = document.getElementById(answerId);
    const icon = button.querySelector('i');

    if (answer.style.display === 'none') {
      answer.style.display = 'block';
      icon.classList.remove('fa-chevron-down');
      icon.classList.add('fa-chevron-up');
    } else {
      answer.style.display = 'none';
      icon.classList.remove('fa-chevron-up');
      icon.classList.add('fa-chevron-down');
    }
  }
