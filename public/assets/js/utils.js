const fetchData = async (url, prefix = 'api') => {
    const uri = `/${prefix}/${url}`;
    try {
        const response = await fetch(uri);
        if (!response.ok) {
            console.error(`HTTP error! Status: ${response.status}`);
            return null;
        }
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
        return null;
    }
}
