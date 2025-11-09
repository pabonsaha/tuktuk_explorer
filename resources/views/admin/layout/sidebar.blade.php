<aside
    :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
    <!-- SIDEBAR HEADER -->
    <div
        :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7"
    >
        <a href="{{route('admin.dashboard')}}">
      <span class="logo flex justify-center items-center" :class="sidebarToggle ? 'hidden' : ''">
        <img class="" src="{{asset('/logo/sidebar_logo.png')}}" alt="Logo"/>
      </span>

            <img
                class="logo-icon"
                :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{asset('/logo/logo.ico')}}"
                alt="Logo"
            />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div
        class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
    >
        <!-- Sidebar Menu -->
        <nav x-data="{selected: $persist('Dashboard')}">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
              class="menu-group-title"
              :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            MENU
          </span>

                    <svg
                        :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill=""
                        />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">

                    <li>
                        <a
                            href="{{route('admin.dashboard')}}"
                            @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                            class="menu-item group"
                            :class=" (selected === 'Dashboard') ? 'menu-item-active' : 'menu-item-inactive'"
                        >
                            <svg
                                :class="(selected === 'Dashboard') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                    fill=""
                                />
                            </svg>

                            <span
                                class="menu-item-text"
                                :class="sidebarToggle ? 'lg:hidden' : ''"
                            >
                Dashboard
              </span>
                        </a>
                    </li>


                    <li>
                        <a
                            href="{{route('admin.banner.index')}}"
                            @click="selected = (selected === 'Banner' ? '':'Banner')"
                            class="menu-item group"
                            :class=" (selected === 'Banner') ? 'menu-item-active' : 'menu-item-inactive'"
                        >
                            <svg
                                :class="(selected === 'Banner') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                    fill=""
                                />
                            </svg>

                            <span
                                class="menu-item-text"
                                :class="sidebarToggle ? 'lg:hidden' : ''"
                            >
                Banner
              </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.tours.index')}}"
                           @click="selected = (selected === 'Tours' ? '':'Tours')"
                           class="menu-item group"
                           :class=" (selected === 'Tours') ? 'menu-item-active' : 'menu-item-inactive'">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 :class="(selected === 'Tours') ? 'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                 width="24"
                                 height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/>
                            </svg>


                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Tours
                            </span>
                        </a>
                    </li>

                    <!-- Menu Item Profile -->
                    <li>
                        <a
                            href="{{route('admin.booking.index')}}"
                            @click="selected = (selected === 'booking' ? '':'booking')"
                            class="menu-item group"
                            :class=" (selected === 'booking') ? 'menu-item-active' : 'menu-item-inactive'"
                        >
                            <svg
                                :class="(selected === 'booking') ?  'menu-item-icon-active'  :'menu-item-icon-inactive'"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                    fill=""
                                />
                            </svg>

                            <span
                                class="menu-item-text"
                                :class="sidebarToggle ? 'lg:hidden' : ''"
                            >
                Booking
              </span>
                        </a>
                    </li>

                </ul>
            </div>


        </nav>
        <!-- Sidebar Menu -->

    </div>
</aside>
