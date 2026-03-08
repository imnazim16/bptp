/**
 * Auto Pop-up Form Script
 *
 * This script handles the automatic display, closing, and submission logic
 * for the dedicated "Auto Pop-up Modal" element on the page.
 * It uses a timer to trigger the modal 1.5 seconds after the DOM is ready.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Select the main elements for the auto pop-up modal
    const autoPopupModal = document.getElementById('auto-popup-modal');
    const autoPopupForm = document.getElementById('auto-popup-form');
    const autoPopupSuccessMessage = document.getElementById('auto-popup-success-message');
    
    // Global flag to prevent re-opening auto-popup modal in the same session load
    let hasAutoPopupShown = false;

    /**
     * Opens the automatic pop-up modal if it hasn't been shown yet.
     */
    const openAutoPopupModal = function() {
        if (!hasAutoPopupShown && autoPopupModal) {
            autoPopupModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
            hasAutoPopupShown = true;
            console.log("Auto Pop-up Modal displayed.");
        }
    }

    /**
     * Closes the automatic pop-up modal.
     * @param {Event} event - The click event (used to check if click was on backdrop/close button).
     */
    const closeAutoPopupModal = function(event) {
         // Only close if the click is on the modal backdrop or the dedicated close button
         if (event.target === autoPopupModal || event.target.closest('button.text-gray-500')) {
            if (autoPopupModal) {
                autoPopupModal.classList.add('hidden');
                document.body.style.overflow = ''; // Restore background scrolling
                console.log("Auto Pop-up Modal closed.");
            }
        }
    }
    
    /**
     * Handles the form submission for the auto pop-up modal.
     * @param {Event} event - The form submission event.
     */
    const handleAutoPopupForm = function(event) {
        event.preventDefault();
        const form = event.target;
        
        console.log(`Auto Pop-up form submitted`, new FormData(form));

        // Hide the form and show the success message
        if (autoPopupForm && autoPopupSuccessMessage) {
            autoPopupForm.style.display = 'none';
            autoPopupSuccessMessage.classList.remove('hidden');

            // Automatically close the modal after 3 seconds for a clean UX
            setTimeout(() => {
                closeAutoPopupModal({ target: autoPopupModal });
            }, 3000);
        }
    }

    // Attach the submission handler to the form
    if (autoPopupForm) {
        autoPopupForm.addEventListener('submit', handleAutoPopupForm);
    }
    
    // Attach the close function globally so the inline close button can call it
    window.closeAutoPopupModal = closeAutoPopupModal;

    // Trigger the auto pop-up after a delay (1500 milliseconds = 1.5 seconds)
    // Adjust this timeout value if you want the pop-up to appear faster or slower.
    const POPUP_DELAY_MS = 1500;
    setTimeout(() => {
        openAutoPopupModal();
    }, POPUP_DELAY_MS);

});// JavaScript Document