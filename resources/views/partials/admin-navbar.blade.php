<div class="h-screen bg-indigo-800 w-80 p-8 left-0 fixed">
 <ul class="text-white">
   <li class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="{{ route('admin.dashboard') }}" class="text-lg">
       <i class="fa-solid fa-table-columns fa-lg mr-6"></i>
       Dashboard
     </a>
   </li>
   <li class="hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="#" class="text-lg">
       <i class="fa-solid fa-circle-question fa-lg mr-6"></i>
       Logo
     </a>
   </li>
   <li class="{{ request()->routeIs('admin.users') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="{{ route('admin.users') }}" class="text-lg">
       <i class="fa-solid fa-users fa-lg mr-5"></i>
       Users
     </a>
   </li>
   <li class="{{ request()->routeIs('admin.meetups') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="{{ route('admin.meetups') }}" class="text-lg">
       <i class="fa-solid fa-calendar-check fa-lg mr-6"></i>
       Meetups
     </a>
   </li>
   <li class="{{ request()->routeIs('admin.organizations') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="{{ route('admin.organizations') }}" class="text-lg">
       <i class="fa-solid fa-sitemap fa-lg mr-5"></i>
       Organizations
     </a>
   </li>
   <li class="{{ request()->routeIs('admin.speakers') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="{{ route('admin.speakers') }}" class="text-lg">
       <i class="fa-solid fa-microphone fa-lg mr-6"></i>
       Speakers
     </a>
   </li>
   <li class="{{ request()->routeIs('admin.news') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-4 py-2 rounded-lg mt-3 hover:cursor-pointer">
     <a href="{{ route('admin.news') }}" class="text-lg">
       <i class="fa-solid fa-newspaper fa-lg mr-6"></i>
       News
     </a>
   </li>
 </ul>
</div>