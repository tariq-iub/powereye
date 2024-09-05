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

const formatTimestamp = (date, timeframe) => {
    switch (timeframe) {
        case '1d':
            return date.toLocaleTimeString('en-GB');

        case '1w':
            return date.toLocaleDateString('en-GB', { weekday: 'long' });

        case '1m':
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short' });

        case '1y':
            return date.toLocaleDateString('en-GB', { month: 'long' });

        case 'all':
            return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' });

        default:
            return date.toLocaleString('en-GB');
    }
};

