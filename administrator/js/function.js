function formatNumber (num) {
	if(num != null)
	{
    	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");		
	} else
	{
		return num;
	}
}