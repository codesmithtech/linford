module.exports = {
    publicPath: '/'
};

if (process.env.NODE_ENV === 'production') {
    module.exports.publicPath = '/vendor/linford/';
}