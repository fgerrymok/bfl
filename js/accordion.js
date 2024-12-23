const accordionItems = document.querySelectorAll('.accordion-column');
const accordionTitle = document.querySelectorAll('.accordion-title');
const plusSign = document.querySelectorAll('.plus-sign');
const minusSign = document.querySelectorAll('.minus-sign');

// Function to set height of accordion items
function setAccordionHeight(index, isOpen) {
  const accordionItem = accordionItems[index].querySelector('.accordion-item');
  if (!accordionItem) return;
  
  if (isOpen) {
    const content = accordionItem.firstElementChild;
    if (content) {
      accordionItem.style.height = `${content.offsetHeight}px`;
    }
  } else {
    accordionItem.style.height = '0px';
  }
}

// Function to update spacing between accordions
function updateAccordionSpacing() {
  accordionItems.forEach((item, index) => {
    // Default spacing for closed accordions
    item.style.marginBottom = '0.5rem';
    
    // Add more space after open accordions
    if (item.querySelector('.accordion-open')) {
      item.style.marginBottom = '1.5rem';
    }
    
    // Remove margin from last item if it's closed
    if (index === accordionItems.length - 1 && !item.querySelector('.accordion-open')) {
      item.style.marginBottom = '0';
    }
  });
}

// Function to close all accordions except the current one
function closeOtherAccordions(currentIndex) {
  accordionTitle.forEach((title, idx) => {
    if (idx !== currentIndex && title.classList.contains('accordion-open')) {
      title.classList.remove('accordion-open');
      plusSign[idx].classList.remove('hide-toggle-sign');
      minusSign[idx].classList.add('hide-toggle-sign');
      setAccordionHeight(idx, false);
    }
  });
  updateAccordionSpacing();
}

// Function to handle accordion toggle
function toggleAccordion(index, shouldOpen) {
  const item = accordionTitle[index];
  
  if (shouldOpen) {
    item.classList.add('accordion-open');
    plusSign[index].classList.add('hide-toggle-sign');
    minusSign[index].classList.remove('hide-toggle-sign');
    setAccordionHeight(index, true);
  } else {
    item.classList.remove('accordion-open');
    plusSign[index].classList.remove('hide-toggle-sign');
    minusSign[index].classList.add('hide-toggle-sign');
    setAccordionHeight(index, false);
  }
  
  updateAccordionSpacing();
}

// Add click event listeners to accordion titles
accordionTitle.forEach((item, index) => {
  item.addEventListener('click', () => {
    const itemIsOpen = item.classList.contains('accordion-open');
    
    if (itemIsOpen) {
      // Close current accordion
      toggleAccordion(index, false);
    } else {
      // Close other accordions first
      closeOtherAccordions(index);
      
      // Open current accordion
      toggleAccordion(index, true);
    }
  });
});

// Initialize accordion state
function initializeAccordion() {
  accordionTitle.forEach((item, index) => {
    setAccordionHeight(index, item.classList.contains('accordion-open'));
  });
  updateAccordionSpacing();
}

// Set initial state on page load
window.addEventListener('load', initializeAccordion);

// Handle window resize
let resizeTimeout;
window.addEventListener('resize', () => {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(initializeAccordion, 250);
});