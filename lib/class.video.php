<?php

Class Video 
{
	public function getVideos($user) 
	{
		$xml = simplexml_load_string(file_get_contents("http://api.justin.tv/api/channel/archives/{$user}.xml?limit=1000"));
		return $xml->object;
	}
	public function getConvertedVideos($dir="../converted/")
	{
		if ($handle = @opendir($dir)) 
		{
			while (false !== ($file = @readdir($handle))) 
			{
				if(preg_match("/.asf/",$file))
				{
					$list[]=array('name'=>$file,'image'=>str_replace('asf','jpg',$file));
				}
		 	}
		}
		return $list;
	}
	public function getClipInfo($clipid) 
	{
		$xml = simplexml_load_string(file_get_contents("http://api.justin.tv/api/clip/show/{$clipid}.xml"));
		return $xml->object;
	}
	public function parseTitle($url)
	{
		$search = array('/(\w)\.(\w)/','/[^\d\w\s-]/i','[\s\W?\s]','[\s]','[39]');
		$replace = array('$1_$2','','_','_','');
		$url = preg_replace($search, $replace, $url);
		return strtolower($url);
	}
	public function checkFileExists($file,$path="../converted/")
	{
		return file_exists($path.$this->parseTitle($file).'.asf') ? "1":"0";
	}
	public function listConvertedVids()
	{		
		if($list=$this->getConvertedVideos())
		{
			foreach($list as $k => $v) 
			{
				$html .= "<div class=\"converted\" style=\"background-image:url(converted/{$v[image]})\" id=\"{$v[name]}\">";
				$html .= "<span class=\"title done\">".$v['name']."</span>";
				$html .= "<span class=\"title size\">Size: ".round((filesize("../converted/".$v['name'])/1024)/1024)."mb</span>";
				$html .= "<span class=\"title\"><a href=\"converted/".$v['name']."\">download</a></span>";
				$html .= "<div class=\"delete\"></div>";
				$html .= "</div>";
			}
		}
		else
		{
			$html = "No videos converted yet.";
		}
		return $html;
	}
	public function listRecordings($user)
	{
		$xml = $this->getVideos($user);
		$html = "<table id=\"video-list\"><thead><tr><th></th><th>title</th><th>size</th><th>length</th><th>part</th><th>start time</th><th></th></tr></thead>";
		for($i=0;$i<count($xml);$i++){
			$exists = $this->checkFileExists($this->parseTitle($xml->$i->title).'_part'.$xml->$i->broadcast_part.'_'.$xml->$i->id);
			$html .= "<tr id=\"$xml->$i->id\">";
			$html .= "<td><img src=\"{$xml->$i->image_url_medium}\" width=\"80px\"/></td>";
			$html .= $exists ? "<td>{$xml->$i->title}</td>":"<td><a href=\"?convert={$xml->$i->id}\" vidid=\"{$xml->$i->id}\" part=\"{$xml->$i->broadcast_part}\" filename=\"".$this->parseTitle($xml->$i->title)."\">{$xml->$i->title}</a></td>";
			$html .= "<td>".round(($xml->$i->file_size/1024)/1024)."mb</td>";
			$html .= "<td>".round($xml->$i->length/60)."min</td>";
			$html .= "<td>{$xml->$i->broadcast_part}</td>";
			$html .= "<td>{$xml->$i->start_time}</td>";
			$html .= $exists ? "<td><img src=\"images/done.png\"/></td>":"<td></td>";
			$html .= "</tr>";
		}
		$html .= "</table>";
		return $html;
	}
}
?>