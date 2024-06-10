export async function client(endpoint,config) {
	 
  let data
  try {
    const response = await window.fetch(endpoint, config)
    data = await response.json()
    if (response.ok) {
      return data
    }
    throw new Error(response.statusText)
  } catch (err) {
    return Promise.reject(err.message ? err.message : data)
  }
   
}

client.send = function (endpoint,method='GET',params=null) {
	  const config={
		method: method,
		mode: 'cors',
		cache: 'no-cache',
		credentials: 'omit', 
		headers: {
		   'Content-Type': 'application/json',
		   'Accept': 'application/json',
		},
		redirect: 'follow',
		referrerPolicy: 'no-referrer',
  }
  
  if(params)
	config.body=JSON.stringify(params);	
  	
  return client(endpoint,config)
}