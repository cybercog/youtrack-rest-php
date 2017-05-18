# To do

## Exceptions

- [ ] (?) Design exceptions (use static or not)

## Client

- [x] Authentication strategy
- [x] Design `YouTrackClient`
- [ ] Design `YouTrackResponse` | `YouTrackGateway` object (Gateway Design Pattern)
- [ ] (?) `YouTrackClient` should has `Endpoints` entity
- [ ] (?) Ignore `Guzzle` exceptions to cleanup code? What if guzzle will be initialized with exceptions flag?
- [ ] (?) Do we need to `YouTrackRestResponse` contract extend `Psr\Http\Message\ResponseInterface`
- [ ] Move `authenticate()` method out from the constructor. It should be called before each request, but prevent authentication call recursion.
- [ ] `authenticate()` or `authorize()`?

## Testing

- [x] Snapshot\Mock\Stub\Fake testing for API calls

## Continuous Integration

- [x] Automate unit tests
- [ ] Coverage analysis
- [ ] Code mess detector
- [x] Code style checker