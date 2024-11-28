<x-xavi-layout>

    <x-slot name="title">Test</x-slot>

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

    <section class="my-4">
        <h2>Preloader</h2>
        <x-xavi.preloader class="px-0"/>
        <x-xavi.preloader class="bg-green-100 text-green-700 border border-green-700"/>
        <x-xavi.preloader class="bg-slate-600 text-white italic w-1/2">Loading records...</x-xavi.preloader>
    </section>

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

    <h2>Logo</h2>
    <section class="flex items-start space-x-4">
        <x-xavi.logo type="small"/>
        <x-xavi.logo type="medium"/>
        <x-xavi.logo type="big" transition="hover:w-52 hover:drop-shadow-lg transition"/>
    </section>

</x-xavi-layout>
