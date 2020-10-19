export default function middlewarePipeline(context, middleware, index) {
    let nextMiddleware = middleware[index];
    if (!nextMiddleware) {
        return context.next;
    }

    return () => {
        const nextPipeline = middlewarePipeline(
            context, middleware, index + 1
        );
        nextMiddleware({ ...context, next: nextPipeline });
    }
}
