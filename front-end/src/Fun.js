class Fun extends Object{
	
	round(num,numd){
		let numdigit=numd?Math.pow(10,numd):0;
		return Math.round(num*numdigit)/numdigit;
	}
	
	
	deg2dms(dec){

		let d=Math.floor(dec);
		let m=Math.floor((dec-d)*60);
		let s=Math.floor(((dec-d)*60-m)*60);
		
		return [d,m,s];
	}
	
	
	dms2deg(d,m,s){

		let temp=[d,m,s].map(function(item){return parseFloat(item);});
		if(temp.length==3){
			temp=temp[0]+(temp[1]/60)+(temp[2]/3600);
		}else if(temp.length==2){
			temp=temp[0]+(temp[1]/60);
		}else{
			temp=temp[0];
		}
		
		return parseFloat(temp);
	}
	
	deg2rad(angle){
		return (angle / 180) * Math.PI;
	}
	
	
	reverceitemarr(locs){
		let arr=new Array(locs.length);
		for(let j=0;j<locs.length;j++){
		arr[j]=[locs[j][1],locs[j][0]];
		}

		return arr;	
	
	}
	
	zeropad(num){
		return String("000000000"+num).slice(-2);
	}
	
	
	spatialFilter(draws){
		
		if(draws==undefined && window.loc!=undefined  && window.loc.length>0)
			draws=window.loc;
		else
			return false;
		
		let loc={"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[]]}};
		for(let i in draws){
			  const item=draws[i];
			  loc['geometry']['coordinates'][0].push([item.lon,item.lat]);
		}
		
		if(loc['geometry']['coordinates'][0].length==0)
			return false;
		else
			return JSON.stringify(loc);
		
	}
	
	
	
	centerPolygon(cords){
		const num=cords.length;
		let mean_x=0;
		let mean_y=0;
		for(let i in cords){
			mean_x+=cords[i][0];
			mean_y+=cords[i][1];
			
		}
		mean_x=mean_x/num;
		mean_y=mean_y/num;
		
		return [mean_x,mean_y]
	}
	
	
	
	bboxPolygon(cords){
		let min_x=200;
		let min_y=100;
		let max_x=0;
		let max_y=-100;
		for(let i in cords){
			
			if(cords[i][0]<min_x){
				min_x=cords[i][0];
			}
			
			if(cords[i][0]>max_x){
				max_x=cords[i][0];
			}
			
			if(cords[i][1]<min_y){
				min_y=cords[i][1];
			}
			
			if(cords[i][1]>max_y){
				max_y=cords[i][1];
			}
			
		}
		
		return [min_x,min_y,max_x,max_y]
	}
	
	
	lon2xtile(lon,zoom){
		return Math.floor(((lon + 180) / 360) * Math.pow(2, zoom));
	}

	lat2ytile(lat,zoom){
		return Math.floor((1 - Math.log(Math.tan(this.deg2rad(lat)) + 1 / Math.cos(this.deg2rad(lat))) / Math.PI) /2 * Math.pow(2, zoom));
	}
	
	
	getZoomLevel(height) {
		const A = 40487.57;
		const B = 0.00007096758;
		const C = 91610.74;
		const D = -40467.74;
		return Math.round(D + (A - D) / (1 + Math.pow(height / C, B)))+1;
	}
	
	
	angle(p1,p2){
		let dy=p2.y-p1.y;
		let dx=p2.x-p1.x;
		if(dx==0 && dy>=0){
			return 0;
		}else if(dx==0 && dy<0){
			return Math.PI;
		}
		
		else if(dy==0 && dx>=0){
			return Math.PI/2;
		}else if(dy==0 && dx<0){
			return 3*Math.PI/2;
		}
		
		else{
			let ang=Math.abs(Math.atan(dx/dy));
			
			if(dx>0 && dy>0){
				return ang;
			}else if(dx>0 && dy<0){
				return Math.PI-ang;
			}else if(dx<0 && dy>0){
				return 2*Math.PI-ang;
			}else if(dx<0 && dy<0){
				return Math.PI+ang;
			}
		}
		
		
	}
	
	
	showShadow(){
		let elem=document.getElementById('shadow');
		if(!elem.classList.contains('shadow-open')){
			elem.classList.add('shadow-open');
		}
	}
	
	
	hideShadow(){
		let elem=document.getElementById('shadow');
		if(elem.classList.contains('shadow-open')){
			elem.classList.remove('shadow-open');
		}
	}
	
	showLoader(){
		let elem=document.getElementById('loader');
		if(!elem.classList.contains('loader-open')){
			elem.classList.add('loader-open');
		}
	}
	
	
	hideLoader(){
		let elem=document.getElementById('loader');
		if(elem.classList.contains('loader-open')){
			elem.classList.remove('loader-open');
		}
	}
	
	

}


export default new Fun();




