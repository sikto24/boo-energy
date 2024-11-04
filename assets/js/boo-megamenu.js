document.addEventListener('DOMContentLoaded', function () {
  // Function to adjust the heights of mega menus
  function adjustMegaMenuHeights() {
    const mainMegaMenus = document.querySelectorAll('.boo-mega-sub-menu');

    mainMegaMenus.forEach(mainMegaMenu => {
      const subMegaMenus = mainMegaMenu.querySelectorAll(
        '.boo-mega-sub-menu-second'
      );

      // Calculate heights
      const mainMenuHeight = mainMegaMenu.clientHeight;

      subMegaMenus.forEach(subMegaMenu => {
        const subMenuHeight = subMegaMenu.clientHeight;

        // Set min-height for main menu
        if (mainMenuHeight < subMenuHeight) {
          mainMegaMenu.style.minHeight = `${subMenuHeight + 80}px`;
          console.log(
            `Adjusted main menu minHeight: ${mainMegaMenu.style.minHeight}`
          );
        } else if (mainMenuHeight > subMenuHeight) {
          subMegaMenu.style.minHeight = `${mainMenuHeight - 80}px`;
          console.log(
            `Adjusted sub menu minHeight: ${subMegaMenu.style.minHeight}`
          );
        }

        // Check if sub-mega-menu exceeds max height
        const maxHeight = 500; // Define your max height here
        if (subMenuHeight > maxHeight) {
          subMegaMenu.style.height = `${maxHeight}px`;
          console.log(
            `Sub menu exceeded max height. Set height to: ${maxHeight}px`
          );
        }
      });
    });
  }

  // Call the function to adjust heights
  adjustMegaMenuHeights();

  // Select all primary menu items with children
  const menuItemsWithChildren = document.querySelectorAll(
    '.primary-menu > li.menu-item-has-children'
  );

  menuItemsWithChildren.forEach(menuItem => {
    let activeItem = null;
    let timeoutId;

    const subMenuItems = menuItem.querySelectorAll(
      '.boo-mega-sub-menu li.menu-item-has-children'
    );

    // Add hover event listeners for each submenu item with children
    subMenuItems.forEach(item => {
      item.addEventListener('mouseenter', () => {
        if (activeItem && activeItem !== item) {
          activeItem.classList.remove('boo-sub-menu-active');
        }
        item.classList.add('boo-sub-menu-active');
        activeItem = item;
      });
    });

    function addClasses() {
      clearTimeout(timeoutId);
      menuItem.classList.add('mega-menu-toggle-on');

      const secondLi = menuItem.querySelector(
        '.boo-mega-sub-menu li.menu-item-has-children:nth-child(2)'
      );
      if (secondLi) {
        secondLi.classList.add('boo-sub-menu-active');
      }
    }

    function removeClasses() {
      timeoutId = setTimeout(() => {
        menuItem.classList.remove('mega-menu-toggle-on');

        const secondLi = menuItem.querySelector(
          '.boo-mega-sub-menu li.menu-item-has-children:nth-child(2)'
        );
        if (secondLi) {
          secondLi.classList.remove('boo-sub-menu-active');
        }

        if (activeItem) {
          activeItem.classList.remove('boo-sub-menu-active');
          activeItem = null;
        }
      }, 300);
    }

    // Attach event listeners to each main menu item with children
    menuItem.addEventListener('mouseenter', addClasses);
    menuItem.addEventListener('mouseleave', function (event) {
      if (!menuItem.contains(event.relatedTarget)) {
        removeClasses();
      }
    });
  });
});
