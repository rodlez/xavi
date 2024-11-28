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

</x-xavi-layout>
