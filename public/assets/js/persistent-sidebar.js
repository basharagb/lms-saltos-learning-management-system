// Gentle Persistent Sidebar - Keep existing layout intact
$(document).ready(function() {
    console.log('Gentle Persistent Sidebar Script Loaded - Keeping existing layout intact');
    
    // Function to ensure sidebar is open without breaking layout
    function ensureSidebarOpen() {
        // Only remove collapse classes, don't change positioning
        $('body').removeClass('sidebar-xs sidebar-mobile-main sidebar-main-hidden');
        
        console.log('Sidebar collapse classes removed - layout preserved');
    }
    
    // Initial setup
    ensureSidebarOpen();
    
    // Prevent sidebar from being toggled to collapsed state
    $(document).off('click', '.sidebar-main-toggle');
    
    // Override the sidebar toggle functionality gently
    $('.sidebar-main-toggle').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        console.log('Sidebar toggle clicked - preventing collapse while preserving layout');
        
        // Only ensure sidebar is expanded, don't change positioning
        ensureSidebarOpen();
        
        // Show a message that sidebar is always open
        if (typeof $.notify !== 'undefined') {
            $.notify({
                message: 'الشريط الجانبي مفتوح دائماً'
            }, {
                type: 'info',
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
        }
        
        return false;
    });
    
    // Also prevent mobile sidebar toggle
    $('.sidebar-mobile-main-toggle').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        console.log('Mobile sidebar toggle clicked - preventing collapse while preserving layout');
        
        // Only ensure sidebar is visible, don't change positioning
        ensureSidebarOpen();
        
        return false;
    });
    
    // Ensure sidebar is always expanded on page load
    $(window).on('load', function() {
        console.log('Window loaded - ensuring sidebar is open while preserving layout');
        ensureSidebarOpen();
    });
    
    // Also ensure sidebar stays open on window resize
    $(window).on('resize', function() {
        console.log('Window resized - ensuring sidebar is open while preserving layout');
        ensureSidebarOpen();
    });
    
    // Override any other sidebar hiding mechanisms
    $(document).off('click', '.sidebar-main-hide');
    $('.sidebar-main-hide').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Sidebar hide clicked - preventing hide while preserving layout');
        ensureSidebarOpen();
        return false;
    });
    
    // Override the original app.js sidebar functionality gently
    if (typeof App !== 'undefined' && App._sidebarMainResize) {
        console.log('Overriding App._sidebarMainResize function gently');
        // Store original function
        var originalSidebarResize = App._sidebarMainResize;
        
        // Override with our gentle version
        App._sidebarMainResize = function() {
            console.log('App._sidebarMainResize called - overriding toggle gently');
            // Call original but then override the toggle
            originalSidebarResize.call(this);
            
            // Remove the toggle event and replace with our gentle version
            $('.sidebar-main-toggle').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Sidebar toggle from app.js overridden gently');
                ensureSidebarOpen();
                return false;
            });
        };
    }
    
    // Set up an interval to continuously ensure sidebar is open (gentle approach)
    setInterval(function() {
        ensureSidebarOpen();
    }, 3000); // Check every 3 seconds to be less aggressive
    
    // Also override on any DOM changes (gentle approach)
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                console.log('Body class changed - ensuring sidebar is open while preserving layout');
                ensureSidebarOpen();
            }
        });
    });
    
    // Start observing
    observer.observe(document.body, {
        attributes: true,
        attributeFilter: ['class']
    });
    
    // Handle orientation change on mobile devices
    $(window).on('orientationchange', function() {
        console.log('Orientation changed - ensuring sidebar is open while preserving layout');
        setTimeout(function() {
            ensureSidebarOpen();
        }, 200);
    });
    
    console.log('Gentle Persistent Sidebar Script Setup Complete - Layout preserved');
});
