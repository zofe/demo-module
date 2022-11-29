<div class="documenter h-100">
<h4>module structure</h4>
<pre>
<code style="color: #bbb">
laravel/
├─ app/
│  ├─ Modules/
│  │  ├─ Demo/
│  │  │  ├─ Components/
│  │  │  │  ├─ Articles/
│  │  │  │  │  ├─ views/
│  │  │  │  │  │  ├─ <span style="{{ url_contains('/article/edit') ? 'color: #007700' :'' }}">articles_edit.blade.php</span>
│  │  │  │  │  │  ├─ <span style="{{ url_contains('/articles') ? 'color: #007700' : '' }}">articles_table.blade.php</span>
│  │  │  │  │  │  ├─ <span style="{{ url_contains('/article/view/') ? 'color: #007700' :'' }}">articles_view.blade.php</span>
│  │  │  │  │  ├─ <span style="{{ url_contains('/article/edit') ? 'color: #007700' : '' }}">ArticlesEdit.php</span>
│  │  │  │  │  ├─ <span style="{{ url_contains('/articles') ? 'color: #007700' : '' }}">ArticlesTable.php</span>
│  │  │  │  │  ├─ <span style="{{ url_contains('/article/view/') ? 'color: #007700' : '' }}">ArticlesView.php</span>
│  │  │  │  ├─ routes.php
</code>
</pre>
</div>
