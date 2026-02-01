 <div class="media">
     <a class="media-left" href="#">
         <img src="{{ asset('assets/front/upload/author.jpg') }}" alt="" class="rounded-circle">
     </a>
     <div class="media-body">
         <h4 class="media-heading user_name">{{ $comment->name }}
             <small>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans() }}</small>
         </h4>
         <p>{!! nl2br(e($comment->comment)) !!}</p>
         <a href="#" class="btn btn-primary btn-sm">Reply</a>
     </div>
 </div>
