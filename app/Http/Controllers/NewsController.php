<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Controllers\Controller;
	use App\Models\Subscribe;
	use Illuminate\Http\Request;
	use App\Models\CmsNews;
	use App\Models\CmsNewsDescription;
	use Mail;
	use View;
	
	class NewsController extends Controller
	{
		//
		public $configs;
		public $configsGlobal;
		
		public function __construct()
		{
			parent::__construct();
			//=======Config====
			$configs = \Helper::configs();
			$configsGlobal = \Helper::configsGlobal();
			//============end config====
			$this->configsGlobal = $configsGlobal;
			$this->configs = $configs;
			
		}
		
		public function tintuc()
		{
			$news = (new CmsNews)->getItemsNews($limit = 12, $opt = 'paginate');
			
			//print_r($news); die('33');
			return view(SITE_THEME . '.cms_news',
				array(
					'title' => trans('language.blog'),
					'description' => $this->configsGlobal['description'],
					'keyword' => $this->configsGlobal['keyword'],
					'news' => $news,
					
				)
			);
		}
		
		public function tintucDetail($name, $id)
		{
			$news_currently = CmsNews::find($id);
			//print_r($news_currently); die();
			//$ngayDang = ($news_currently) ? $news_currently->created_at : trans('language.not_found');
			//print_r($news_currently['created_at']->date); die();
		//	$news_currently->visits()->increment();
		//	$countPost = $news_currently->visits()->count();
			if ($news_currently) {
				$title = ($news_currently) ? $news_currently->title : trans('language.not_found');
			
			
				return view(SITE_THEME . '.cms_news_detail',
					array(
						'title' => $title,
					//	'ngaydang'=>$ngayDang->date,
						'news_currently' => $news_currently,
						'baivietkhacs' => (new CmsNews)->getBaiVietKhac($id),
						//'count' => $countPost,
						'description' => (new CmsNews)->getDescriptionById($id),
						'keyword' => (new CmsNews)->getKeywordById($id),
						'blogs' => (new CmsNews)->getItemsNews($limit = 4),
						'og_image' => url(SITE_PATH_FILE . '/' . $news_currently->image),
					)
				);
			} else {
				return view(SITE_THEME . '.notfound',
					array(
						'title' => trans('language.not_found'),
						'description' => '',
						'keyword' => $this->configsGlobal['keyword'],
					)
				);
			}
		}
		
		
	}
