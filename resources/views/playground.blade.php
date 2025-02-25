<x-xavi-layout>

    {{-- Add the Title and Description in the parent layout (xavi) title and description in the HEAD --}}
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="description">{{ $description }}</x-slot>

    {{-- TITLE AND DESCRIPTION COMPONENT --}}

    {{-- Title --}}
    @if (isset($title))
        <x-xavi.title type="main" bgColor="bg-violet-600">{{ $title }}</x-xavi.title>
    @endif
    {{-- Description --}}
    @if (isset($description))
        <x-xavi.description bgColor="bg-orange-100">{{ $description }}</x-xavi.description>
    @endif

    {{-- Form --}}
    <h2>Form</h2>
    <form class="grid grid-cols-10 gap-4">
        {{-- text input --}}
        <div class="col-span-10 sm:col-span-5">
            <x-label for="name" value="Name" />
            <x-input id="name" type="text" class="block mt-1 w-full" placeholder="Your name" />
        </div>
        {{-- select --}}
        <div class="col-span-10 sm:col-span-5">
            <x-label for="country" value="Select a country" />
            <x-xavi.form.select id="country" type="text" class="block mt-1 w-full">
                <option value="Belgium">Belgium</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
            </x-xavi.form.select>
        </div>
        {{-- textarea --}}
        <div class="col-span-10">
            <x-label for="message" value="Message" />
            <x-xavi.form.textarea id="message" class="block mt-1 w-full" rows="6" placeholder="Your message">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, corporis!
            </x-xavi.form.textarea>
        </div>
    </form>

    {{-- Buttons --}}
    <h2>Buttons</h2>
    <section class="flex space-x-4">
        <x-xavi.form.button type="button">default button</x-xavi.form.button>
        <x-xavi.form.button type="button" color="success">success button</x-xavi.form.button>
        <x-xavi.form.button type="button" color="danger">danger button</x-xavi.form.button>
        <x-xavi.form.button type="button" color="info">info button</x-xavi.form.button>
    </section>

    <h2>Disabled buttons</h2>
    <section class="flex space-x-4">
        <x-xavi.form.button type="button" disabled>default button</x-xavi.form.button>
        <x-xavi.form.button type="button" color="success" disabled>success button</x-xavi.form.button>
        <x-xavi.form.button type="button" color="danger" disabled>danger button</x-xavi.form.button>
        <x-xavi.form.button type="button" color="info" disabled>info button</x-xavi.form.button>
    </section>

    {{-- Search --}}
    <h2>Search</h2>
    <x-xavi.form.search placeholder="Search..." />

    {{-- Toggle --}}
    <section>
        <h2>Toggle switch</h2>
        <div class="flex items-center gap-4">
            <x-xavi.form.toggle />
            <x-xavi.form.toggle color="success" checked />
            <x-xavi.form.toggle color="danger" class="rotate-90" />
            <x-xavi.form.toggle color="info" />
            <x-xavi.form.toggle color="danger" checked disabled />
        </div>
    </section>

    {{-- Switch --}}
    <section class="my-4">
        <h2>Switch</h2>
        <div class="flex items-center gap-4">
            <x-xavi.form.switch />
            <x-xavi.form.switch checked color-off="bg-red-200" />
            <x-xavi.form.switch disabled />
            <x-xavi.form.switch checked name="save" value="Save me" class="text-white shadow-lg !rounded-full w-28"
                color-off="bg-orange-800" color-on="bg-sky-800" text-off="switch off" text-on="switch on" />
            <x-xavi.form.switch name="user" value="on" class="!h-20 !text-5xl" color-off="bg-red-200"
                color-on="bg-green-500" text-on="😊" text-off="😩" />
        </div>
    </section>

    {{-- Dynamic Data --}}
    <h2>Dynamic data</h2>
    <section class="flex flex-col">
        @php
            $color = 'danger'; // $color is a dynamic value !!!
        @endphp

        <x-xavi.alert type="$color">
            Is this a red, danger alert?<br>
            No, <code class="px-2 text-blue-600 font-black">type="$color"</code> don't work with dynamic values.
        </x-xavi.alert>

        <x-xavi.alert :type="$color">
            Is this a red, danger alert?<br>
            Yes, use <code class="px-2 text-blue-600 font-black">:type="$color"</code> for dynamic values.
        </x-xavi.alert>
    </section>

    {{-- Lists --}}
    <x-xavi.list title="Order list" type="ol" bgColor="bg-orange-400" titleList="Albums">
        <li>Queen - <b>Greatest Hits</b></li>
        <li>The Rolling Stones - <i>Sticky Fingers</i></li>
        <li>The Beatles - Abbey Road</li>
        <li>The Who - Tommy</li>
    </x-xavi.list>

    <x-xavi.list title="Unorder list">
        <li>Queen - <b>Greatest Hits</b></li>
        <li>The Rolling Stones - <i>Sticky Fingers</i></li>
        <li>The Beatles - Abbey Road</li>
        <li>The Who - Tommy</li>
    </x-xavi.list>

    <x-xavi.list title="Group list" type="group" bgColor="bg-white">
        <li>Queen - <b>Greatest Hits</b></li>
        <li>The Rolling Stones - <i>Sticky Fingers</i></li>
        <li>The Beatles - Abbey Road</li>
        <li>The Who - Tommy</li>
    </x-xavi.list>

    {{-- Sections --}}
    <h2>Sections</h2>
    <div class="grid grid-cols-3 gap-4">
        <x-xavi.section class="col-span-3 md:col-span-1">
            <h3>Section 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi ducimus fuga nesciunt nisi quo sequi
                voluptas. Accusantium consequuntur officiis veritatis.</p>
        </x-xavi.section>
        <x-xavi.section class="col-span-3 md:col-span-1">
            <h3>Section 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab distinctio eos ex excepturi possimus,
                reprehenderit vitae voluptatum. Accusamus eius eum ex, explicabo illo iste maxime odio soluta, vero
                voluptas, voluptate!</p>
        </x-xavi.section>
        <x-xavi.section class="col-span-3 md:col-span-1">
            <h3>Section 3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, quasi?</p>
        </x-xavi.section>
    </div>
    {{-- Preload --}}
    <section class="my-4">
        <h2>Preloader</h2>
        <x-xavi.preloader class="px-0" />
        <x-xavi.preloader class="bg-green-100 text-green-700 border border-green-700" />
        <x-xavi.preloader class="bg-slate-600 text-white italic w-1/2">Loading records...</x-xavi.preloader>
    </section>

    {{-- Alerts --}}
    <section class="my-4">
        <h2>Alerts</h2>
        <x-xavi.alert>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis dolores dolorum error eum eveniet
            exercitationem expedita, impedit itaque laudantium, natus, nobis numquam omnis praesentium quis reiciendis
            soluta sunt vel vero.
        </x-xavi.alert>
        <x-xavi.alert type="danger" class="mt-8 shadow-xl">
            lorem ipsum
        </x-xavi.alert>
        <x-xavi.alert type="info" class="mt-8">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus eligendi facilis libero maiores non,
            praesentium quam reiciendis sunt ut voluptatibus.
        </x-xavi.alert>
        <x-xavi.alert type="warning" dismissible="false" close-self="5000">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus eligendi facilis libero maiores non,
            praesentium quam reiciendis sunt ut voluptatibus.
        </x-xavi.alert>
    </section>

    {{-- Logo --}}
    <h2>Logo</h2>
    <section class="flex items-start space-x-4">
        <x-xavi.logo type="small" />
        <x-xavi.logo type="medium" />
        <x-xavi.logo type="big" transition="hover:w-52 hover:drop-shadow-lg transition" />
    </section>

</x-xavi-layout>
