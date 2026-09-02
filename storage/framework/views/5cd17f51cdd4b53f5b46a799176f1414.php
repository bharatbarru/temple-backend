
<div class="navbar-container ">
    <nav class="navbar navbar-expand-lg  navbar-light">
      <div class="container">
        <a class="navbar-brand fade-page hide-991" href="<?php echo e(url('/')); ?>">
            <img class="main-logo logo-dark logo-default" alt="<?php echo e(applicationSettingsAltText('logo')); ?>"
                src="<?php echo e(asset(APPLICATION_SETTING_IMAGE_PATH . applicationSettings('logo'))); ?>" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                class="injected-svg icon navbar-toggler-open" data-src="assets/img/icons/interface/menu.svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <path
                    d="M3 17C3 17.5523 3.44772 18 4 18H20C20.5523 18 21 17.5523 21 17V17C21 16.4477 20.5523 16 20 16H4C3.44772 16 3 16.4477 3 17V17ZM3 12C3 12.5523 3.44772 13 4 13H20C20.5523 13 21 12.5523 21 12V12C21 11.4477 20.5523 11 20 11H4C3.44772 11 3 11.4477 3 12V12ZM4 6C3.44772 6 3 6.44772 3 7V7C3 7.55228 3.44772 8 4 8H20C20.5523 8 21 7.55228 21 7V7C21 6.44772 20.5523 6 20 6H4Z"
                    fill="#212529"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                class="injected-svg icon navbar-toggler-close" data-src="assets/img/icons/interface/cross.svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <path
                    d="M16.2426 6.34311L6.34309 16.2426C5.95257 16.6331 5.95257 17.2663 6.34309 17.6568C6.73362 18.0473 7.36678 18.0473 7.75731 17.6568L17.6568 7.75732C18.0473 7.36679 18.0473 6.73363 17.6568 6.34311C17.2663 5.95258 16.6331 5.95258 16.2426 6.34311Z"
                    fill="#212529"></path>
                <path
                    d="M17.6568 16.2426L7.75734 6.34309C7.36681 5.95257 6.73365 5.95257 6.34313 6.34309C5.9526 6.73362 5.9526 7.36678 6.34313 7.75731L16.2426 17.6568C16.6331 18.0473 17.2663 18.0473 17.6568 17.6568C18.0474 17.2663 18.0474 16.6331 17.6568 16.2426Z"
                    fill="#212529"></path>
            </svg>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
          <div class="py-2 py-lg-0">
            <ul class="navbar-nav">
                <?php $__currentLoopData = mainMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li
                    class="nav-item <?php echo e($menu->subMenu->count() > 0 ? 'dropdown' : ''); ?> <?php echo e(Request::is($menu->slug) ? 'active' : ''); ?>">
                    <a href="<?php echo e(pageLink($menu->type, $menu->slug, $menu->custom_url)); ?>"
                        class="nav-link <?php echo e($menu->subMenu->count() > 0 ? 'dropdown-toggle' : ''); ?>"
                        <?php if($menu->subMenu->count() > 0): ?> data-toggle="dropdown-grid" aria-expanded="false" aria-haspopup="true" <?php endif; ?>
                        <?php if($menu->custom_url): ?> target="_blank" <?php endif; ?>>
                        <?php echo e($menu->title); ?>

                        <?php if($menu->subMenu->count()): ?>
                            <span class="material-symbols-outlined arrow-right">
                                keyboard_arrow_down
                            </span>
                        <?php endif; ?>
                    </a>
                    <?php if($menu->subMenu->count()): ?>
                        <div class="dropdown-menu row">
                            <div class="col-auto" data-dropdown-content>
                                <div class="dropdown-grid-menu">
                                    <?php $__currentLoopData = $menu->subMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(pageLink($subMenu->type, $subMenu->slug, $subMenu->custom_url)); ?>"
                                            class="dropdown-item fade-page"
                                            <?php if($subMenu->custom_url): ?> target="_blank" <?php endif; ?>>
                                            
                                            <?php echo e($subMenu->title); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- Cart Icon -->
            <li class="nav-item">
                <a href="<?php echo e(url('/cart')); ?>" class="nav-link cart-icon position-relative">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <!-- Cart count badge -->
                    <span class="cart-count badge badge-primary position-absolute" style="right: -10px; top: -5px;">
                        <?php echo e(count(session()->get('cart', []))); ?>

                    </span>
                </a>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <?php if(auth('customers')->check()): ?>
                    <a href="#" class="nav-link dropdown-toggle btn btn-tertiary" data-toggle="dropdown">
                        Hi, <?php echo e(auth('customers')->user()->name); ?>

                        <span class="material-symbols-outlined arrow-right">
                            keyboard_arrow_down
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="<?php echo e(url('/profile')); ?>" class="dropdown-item">Profile</a>
                        <a href="<?php echo e(url('/orders')); ?>" class="dropdown-item">Orders</a>
                        <a href="<?php echo e(url('/logout')); ?>" class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="<?php echo e(url('/user-logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                  
                <?php else: ?>
                    <a href="<?php echo e(url('/user-login')); ?>" class="nav-link btn btn-tertiary">Login</a>
                <?php endif; ?>
            </li>
            </ul>
          </div>

        </div>
      </div>
    </nav>
  </div>


<div class="navbar-container ">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
           
            <div class="collapse navbar-collapse justify-content-between">
                <div class="py-2 py-lg-0">
                    <ul class="navbar-nav">
                      
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<!-- Add the script to fetch and update the cart count -->
<script>
    // Function to fetch and update cart count
    function updateCartCount() {
        fetch('<?php echo e(route("cart.count")); ?>')
            .then(response => response.json())
            .then(data => {
                // Select all elements with the class .cart-count
                const cartCountElements = document.querySelectorAll('.cart-count');
                // Update each element's content and display style
                cartCountElements.forEach(cartCountElement => {
                    if (data.count > 0) {
                        cartCountElement.textContent = data.count;
                        cartCountElement.style.display = 'inline'; // Show the badge
                    } else {
                        cartCountElement.style.display = 'none'; // Hide if no items in cart
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });
    }

    // Call updateCartCount when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        updateCartCount();
    });
</script>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\resources\views\pages\frontend-menu.blade.php ENDPATH**/ ?>