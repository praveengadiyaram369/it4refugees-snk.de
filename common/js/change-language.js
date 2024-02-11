function changeLanguage(languageCode) {
    // Get the current URL
    var currentUrl = window.location.href;
    console.log("Current URL:", currentUrl);
    
    // Extract the pathname from the URL
    var pathname = window.location.pathname;
    console.log("Pathname:", pathname);
    
    // Extract the language code from the pathname
    var languageRegex = /\/(en|de|uk|ar)\//;
    var match = pathname.match(languageRegex);
    var currentLanguage = match ? match[1] : 'en';
    console.log("Current Language:", currentLanguage);
    
    // Construct the new URL with the selected language code
    var newUrl = currentUrl.replace('/' + currentLanguage + '/', '/' + languageCode + '/');
    console.log("New URL:", newUrl);
    
    // Navigate to the new URL
    window.location.href = newUrl;
}