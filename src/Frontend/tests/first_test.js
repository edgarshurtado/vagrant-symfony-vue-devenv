import dummy from './dummy.js'

describe("A suite", function() {
    it("contains spec with an expectation", function() {
        const result = dummy()
        expect(result).toBe(true);
    });
});