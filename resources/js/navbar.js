document.addEventListener('DOMContentLoaded', () => {
  // Mobile Menu Toggling
  const mobileMenuToggle = document.querySelector('[data-menu-toggle="mobile"]');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileMenuToggle.addEventListener('click', () => {
    const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true' || false;
    mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
    mobileMenu.classList.toggle('hidden');
  });

  // Profile Dropdown Toggling
  const profileDropdownToggle = document.querySelector('[data-dropdown-toggle="profile"]');
  const profileDropdownMenu = document.querySelector('[data-dropdown-menu="profile"]');
  const profileDropdown = document.querySelector('[data-dropdown="profile"]');

  profileDropdownToggle.addEventListener('click', () => {
    const isExpanded = profileDropdownToggle.getAttribute('aria-expanded') === 'true' || false;
    profileDropdownToggle.setAttribute('aria-expanded', !isExpanded);
    profileDropdownMenu.classList.toggle('hidden');
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', (event) => {
    if (profileDropdown && !profileDropdown.contains(event.target)) {
      profileDropdownToggle.setAttribute('aria-expanded', 'false');
      profileDropdownMenu.classList.add('hidden');
    }
  });
});