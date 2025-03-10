<x-xavi-layout>    

    <x-slot name="description">New description</x-slot>
    <x-slot name="title">{{__("homepage.title")}}</x-slot>

    {{ Auth::user() != null ? `<h2> __("welcome", ["name" => Auth::user()->name]) </h2>` : '' }}

    {{--   
    @if(Auth::user()) 
        <h2> {{ __('welcome', ['name' => Auth::user()->name]) }} </h2>
    @endif 
    --}}

    <h3>{{ __('Elegant Laravel') }}</h3>
  
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque inventore delectus tenetur ut architecto obcaecati nostrum accusamus nam! At mollitia consectetur earum fuga cum velit nulla inventore, quis recusandae adipisci voluptatem eum distinctio officiis numquam voluptatum. Maxime aspernatur nam magni rerum, accusantium aperiam sunt nihil similique facilis voluptatibus molestias, ut eius porro quaerat est eligendi totam necessitatibus vel. Nobis, deleniti? Repellat amet ducimus esse quo aliquam laudantium nobis. Impedit veniam dolorem facilis libero distinctio. Perferendis, eos id eveniet assumenda, obcaecati quibusdam magnam consequatur veniam deleniti suscipit sit unde maxime velit. Distinctio saepe dicta voluptatibus eum consequatur recusandae, consectetur quam aspernatur velit molestias, aliquam quisquam unde veniam a. Amet non magni ipsam, voluptatibus provident laborum, architecto tenetur aut recusandae, beatae ut adipisci consectetur earum assumenda voluptatem placeat! Eius numquam recusandae voluptas, dolore laborum sit dolores delectus ipsa obcaecati itaque facere corporis, minus odit fuga. Labore architecto vitae provident deleniti numquam neque debitis fuga facere accusamus tempora odit aspernatur officia, porro minus. Obcaecati dolorum reprehenderit temporibus repudiandae provident blanditiis odit dolores molestiae et? Minima fugiat quo fuga totam accusamus omnis quam quisquam inventore, aut neque voluptate sit explicabo modi enim est eveniet eos? Impedit enim pariatur optio mollitia placeat a minima totam. Ducimus, doloremque veritatis ipsa magnam cum fugiat quas sequi. Quo sint temporibus quas voluptatibus modi, iure numquam sapiente architecto fugit repellendus dignissimos nemo, perspiciatis dolore id maiores quidem debitis optio dolores totam molestiae deserunt atque maxime? Ut commodi, delectus, ipsum, cumque libero molestias illo aut sint possimus quibusdam asperiores laudantium dolor! Veritatis impedit, cum neque minima ea modi! Nisi ullam quam saepe, in aliquam voluptates officiis repellat cum dolorem mollitia sit exercitationem laboriosam modi totam cumque accusantium facilis. Rem dicta asperiores officiis maxime doloremque veniam nihil aut possimus tempora? Neque, alias soluta. Obcaecati, voluptatum sit adipisci assumenda laudantium numquam tempore magnam nobis perferendis aliquid cupiditate quidem at porro veritatis aspernatur, fugiat dolores, alias modi consequuntur dicta quam. Similique dolor corrupti consequatur optio earum adipisci fuga consequuntur, beatae error incidunt quaerat, in exercitationem vitae laudantium natus accusamus porro eligendi libero. Nesciunt et ipsam porro est dolorum, pariatur, ab numquam rem corrupti a nulla, eum quia iste officiis ut quam veniam ducimus! Architecto consequuntur porro ipsa autem quibusdam a nemo quae, dignissimos inventore id, laborum quis sit, nihil possimus voluptatem corrupti? Minus, possimus aut nihil, quas similique, quo magni libero nam optio rem illo. Facere perspiciatis omnis, consequuntur debitis ipsam ex eos labore autem, aut quis blanditiis? Eveniet, provident? Magni voluptate consectetur placeat reprehenderit sed deserunt blanditiis itaque temporibus? Possimus consectetur voluptatum reprehenderit. Eveniet a voluptate ut rem dolorum, pariatur rerum at excepturi exercitationem porro optio corrupti nesciunt vel facere nemo? Impedit, magni excepturi modi asperiores molestias minima dolor dolore odit quae laudantium tempore. Illum delectus placeat, dignissimos magnam earum, necessitatibus id magni corporis, modi repellat minus omnis molestiae consequatur aut! Eos iusto distinctio eum, facilis omnis quaerat ipsum molestiae, iste expedita aliquam velit nam neque reprehenderit dolor modi nostrum doloremque maiores veritatis earum libero nemo ipsam, ab ipsa. Labore, placeat explicabo?</p>

    <x-button>oli</x-button>

    


    @push('script')
        <script>
            console.log('XavRod JavaScript works! 🙂')
        </script>
    @endpush
</x-xavi-layout>