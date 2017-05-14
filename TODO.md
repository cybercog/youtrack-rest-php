# To do

## Entities

- [ ] Issue
- [ ] Issue Comment
- [ ] Issue Field color
- [ ] Issue FieldValue
- [ ] Project
- [ ] Relation collections

## Exceptions

- [ ] (?) Design exceptions (use static or not)

## Client

- [x] Authentication strategy
- [ ] Design `YouTrackClient` | `YouTrackConnection`
- [ ] Design `YouTrackResponse` | `YouTrackGateway` object
- [ ] (?) `YouTrackClient` should has `Endpoints` entity
- [ ] (?) Ignore `Guzzle` exceptions to cleanup code? What if guzzle will be initialized with exceptions flag?
- [ ] (?) Do we need to `YouTrackRestResponse` contract extend `Psr\Http\Message\ResponseInterface`

## Repositories

### Issue Repository

- [x] Issue get
- [x] Issue create
- [x] Issue update
- [x] Issue delete
- [x] Issue exists check
- [ ] Issue patch (update only provided params)

### Project Repository

- [x] Project list
- [x] Project get
- [x] Project create
- [ ] Project update
- [x] Project delete

## Framework Integrations

### Laravel

- [x] Laravel integration
- [x] Design Laravel config

### Symfony

- [ ] Symfony integration
- [ ] (?) Can Symfony share Laravel config

## Testing

- [ ] Snapshot\Mock\Stub\Fake testing for API calls

## Continuous Integration

- [x] Automate unit tests
- [ ] Coverage analysis
- [ ] Code mess detector
- [x] Code style checker
